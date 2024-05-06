<?php

namespace App\Http\Controllers\Admin;
use App\Models\Area;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Status;
use App\Models\Upazila;


use App\Models\District;
use App\Models\Division;
use App\Models\UserType;
use Barryvdh\DomPDF\PDF;
use App\Models\Association;
use Illuminate\Support\Str;
use App\Exports\UsersExport;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Helper\EnglishToBanglaDate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
  
  const VIEW_PATH = 'admin.admin.';
  public function __construct()
  {
  }

  public function index(Request $request)
  {
    $admins = Admin::with('role','userType','association','area','branch')->utwd()->orderBy('id','desc')->paginate(100);
    return view(self::VIEW_PATH . 'index',compact('admins'));
  }

  public function datatable(Request $request)
  {
    if ($request->ajax()) {
      //$authAdmin = Auth::user();
      $authAdmin = Auth::guard('admin')->user();

      $admins = Admin::with('role','userType')->latest()->take(100)->get();

      //dd($admins);

      return DataTables::of($admins)
      ->addIndexColumn()
      ->editColumn('created_at', function (Admin $admin) use ($authAdmin) {
        //return date('d-m-Y', strtotime($admin->created_at));
        return $retVal = (app()->getLocale() == 'en') ? date('d-m-Y', strtotime($admin->created_at)) : dateFormatEnglishToBanglaHlp(date('d-m-Y', strtotime($admin->created_at))) ;
      })
      ->editColumn('status', function (Admin $admin) use ($authAdmin) {
        return __('admin.status.'.Status::LIST[$admin->status]);
      })
      ->addColumn('thumb', function (Admin $admin) use ($authAdmin) {
          if (!empty($admin->thumb)) {
              return "<a style=\"margin-left: 30%;\" target=\"_blank\" href='".asset('storage/'.$admin->thumb)."'><i class=\"fa fa-eye fa-2x\" aria-hidden=\"true\"></i></a>";
          }else{
              return "<a style=\"margin-left: 30%;\"><i class=\"fa fa-eye-slash fa-2x\" aria-hidden=\"true\"></i> </a>";
          }
      })
      ->addColumn('action', function (Admin $admin) use ($authAdmin) {
        $str = '<div>';
        $str .= '<a href="'.route('admin.admin.edit', $admin->id) .'" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>';
        $str .= '<a href="'.route('admin.admin.delete', $admin->id) .'" class="delete btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
        $str .= '</div>';
        return $str;
      })
      ->rawColumns(['thumb','action'])
      ->make(true);
    }
    
  }

  public function create()
  {
    //$this->authorize('create',Admin::class);
    
    $user_types = UserType::utwd()->get();
    $roles = Role::utwd()->get();

    $areas = Area::get();
    $branches = Branch::get();
    return view(self::VIEW_PATH . 'add_edit', compact('user_types','roles','areas','branches'));
  }

  public function store(Request $request)
  {
    
    //$this->authorize('create',Admin::class);
    $this->validate($request, [
      'thumb' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:20000',
      //'thumb' => 'required',
      'status' => 'required',
      //'name' => 'required|min:1|max:128',
      'title_en' => 'required|min:1|max:128',
      'title_bn' => 'required|min:1|max:128',
      'username' => 'required|unique:admins|min:1|max:128',
      'email' => 'required|email|unique:admins|min:1|max:128',
      'password' => 'required|confirmed|min:6',
    ]);


    $authUser = Auth::guard('admin')->user()->load(['userType']);
    if (Admin::DEFAULT_ROLE_LIST[1] != $authUser->userType->default_role) {
      if ($request->user_type == Admin::DEFAULT_ROLE_LIST[1]) {
        return back()->with([
          'error' => __('admin.common.error'),
          'alert-type' => 'error'
        ]);
      }
    }

    //dd($request->all());

    try {
      $data = $request->except('_token');
      $authAdmin = Auth::guard('admin')->user()->id;
      array_walk_recursive($data, function (&$val) {
          $val = trim($val);
          $val = is_string($val) && $val === '' ? null : $val;
      });

      $admin = DB::table('admins')->orderBy('id','DESC')->first();

      if ($admin) {
        $data['code'] = $admin->code + 1;
      } else {
        $data['code'] = 1;
      }


      $data['remember_token'] = Str::random(10);
      $data['email_verified_at'] = now();
      $data['created_by'] = $authAdmin;
      $data['password'] = Hash::make($request->password);
      if ($request->hasFile('thumb')) {
        $thumb = $request->file('thumb');
        $randNumber = rand(1, 999);
        $name = 'thumb-' . $authAdmin . '-' . time() . $randNumber . '.' . $thumb->getClientOriginalExtension();
        $year = date('Y/');
        $month = date('F/');
        $destinationPath = storage_path('app/public/admin/' . $year . $month);
        $thumb->move($destinationPath, $name);
        $filePath = 'admin/' . $year . $month;
        $data['thumb'] = $filePath . '' . $name;
      }

      $data['username'] = $data['email'];


      Admin::create($data);
      Cache::forget('locWiseAuthUserInfo');
    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }

    return redirect()->route('admin.admin')->with([
                    'message' => __('admin.common.success'),
                    'alert-type' => 'success'
                ]);
  }

  public function edit(Request $request, $id)
  {



    //$this->authorize('update',Admin::class);
    $admin = DB::table('admins')->where(['id'=>$id])->first();
    $user_types = UserType::utwd()->get();
    $roles = Role::utwd()->get();

    $authUser = Auth::guard('admin')->user()->load(['userType']);
    $role = $authUser->userType->default_role;

    

    $associations = Association::get();
    $areas = Area::get()->where('association_id',$admin->association_id);
    $branches = Branch::get()->where('area_id',$admin->area_id);
    //return $admin;

    #Edit Validation
      
      if ($role <=2) {
        
      }elseif($role ==3){
        if ($admin->user_type_id < $role) {
          return back()->with([
            'error' => __('admin.common.error'),
            'alert-type' => 'error'
          ]);
        }
      }else{
        if ($admin->user_type_id < $role) {
          return back()->with([
            'error' => __('admin.common.error'),
            'alert-type' => 'error'
          ]);
        }
      }
    #Edit Validation
    
    return view(self::VIEW_PATH . 'add_edit', compact('admin','user_types','roles','associations','areas','branches'));
  }

  public function update(Request $request, $id)
  {
    //$this->authorize('update',Admin::class);
    
    $this->validate($request, [
      'thumb' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:20000',
      //'thumb' => 'required',
      'status' => 'required',
      //'name' => 'required|min:1|max:128',
      'title_en' => 'required|min:1|max:128',
      'title_bn' => 'required|min:1|max:128',
      'username' => ['required', Rule::unique('admins')->ignore($id)],
      'email' => ['required', Rule::unique('admins')->ignore($id)],
      //'password' => 'required|confirmed|min:6',
    ]);
    //dd($request->all());

    $authUser = Auth::guard('admin')->user()->load(['userType']);
    if (Admin::DEFAULT_ROLE_LIST[1] != $authUser->userType->default_role) {
      if ($request->user_type == Admin::DEFAULT_ROLE_LIST[1]) {
        return back()->with([
          'error' => __('admin.common.error'),
          'alert-type' => 'error'
        ]);
      }
    }


    try {

      $admin = Admin::where(['id'=>$id])->first();
      if ( is_null($admin) == true) {
        return back()->with([
          'error' => __('admin.common.error'),
          'alert-type' => 'error'
        ]);
      }
      $data = $request->except('_token');
      
      $authAdmin = Auth::guard('admin')->user()->id;
  
      array_walk_recursive($data, function (&$val) {
          $val = trim($val);
          $val = is_string($val) && $val === '' ? null : $val;
      });
  
      $data['updated_by'] = $authAdmin;
  
      if ($request->hasFile('thumb')) {
        @unlink(storage_path('/app/public/' . $admin->thumb));
        $thumb = $request->file('thumb');
        $randNumber = rand(1, 999);
        $name = 'thumb-' . $authAdmin . '-' . time() . $randNumber . '.' . $thumb->getClientOriginalExtension();
        $year = date('Y/');
        $month = date('F/');
        $destinationPath = storage_path('app/public/admin/' . $year . $month);
        $thumb->move($destinationPath, $name);
        $filePath = 'admin/' . $year . $month;
        $data['thumb'] = $filePath . '' . $name;
      }
  
      if ($authAdmin == $id) {
        $data['status'] = true;
      }
  
      Admin::find($id)->update($data);
      Cache::forget('locWiseAuthUserInfo');
    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }


    return redirect()->route('admin.admin')->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);

  }

  public function delete(Request $request,$id,$sid=0)
  {
    //$this->authorize('delete',Admin::class);

    $admin = Admin::find($id);
    if ( is_null($admin) == true) {
      return back()->with([
        'error' => __('admin.common.error'),
        'alert-type' => 'error'
      ]);
    }

    $authAdmin = Auth::guard('admin')->user()->id;

    if ($id == $authAdmin) {
      return back()->with([
        'error' => __('admin.common.error'),
        //'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }

    try {
      if ($sid==false) {
        $admin->status = false;
        $admin->save();
      } else {
        @unlink(storage_path('/app/public/' . $admin->thumb));
        $admin->delete();
      }
      Cache::forget('locWiseAuthUserInfo');
      
    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }
    return redirect()->route('admin.admin')->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);
  }

  
  public function export() 
  {
    return "Hello";
  }

  public function pdf() {
    // retreive all records from db
    //$data = Employee::all();

    $admins = Admin::all();

    // share data to view
    //view()->share('employee',$data);
    $pdf = PDF::loadView(self::VIEW_PATH . 'pdf', compact('admins'))->setOptions(['defaultFont' => 'sans-serif']);

    // download PDF file with download method
    return $pdf->download('pdf_file.pdf');
  }


}
