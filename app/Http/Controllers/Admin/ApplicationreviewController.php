<?php

namespace App\Http\Controllers\Admin;
use App\Models\Area;
use App\Models\User;
use App\Models\Admin;

use App\Models\Approval;
use App\Models\Branch;
use App\Models\Service;
use App\Models\Category;
use App\Models\OfficeType;
use App\Models\Applicationreview;
use App\Models\Association;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class ApplicationreviewController extends Controller
{
  const VIEW_PATH = 'admin.applicationreview.';
  public function __construct()
  {

  }

  public function index()
  {
    $this->authorize('read',Applicationreview::class);
    $applications = Applicationreview::with('association','area','branch','category','service', 'serviceType', 'user','file','approval')->whereIn('approval_id',[Admin::CANCEL])->orderBy('id','desc')->utwd()->paginate(100);
    $authUser = Auth::guard('admin')->user();
    //dd($authUser);
    //dd($applications);
    
    return view(self::VIEW_PATH . 'index',compact('applications'));
  }

  public function create()
  {
    $this->authorize('create',Applicationreview::class);

    $associations = Association::get();
    $areas = Area::utwd()->get();
    $branches = Branch::utwd()->get();
    $office_types = OfficeType::get();

    $categories = Category::get();
    $services = Service::get();
    $users = User::get();

    $approvals = Approval::whereIn('id',[Admin::PENDING])->get();

    return view(self::VIEW_PATH . 'add_edit', compact('associations','areas','branches','office_types','categories','services','users','approvals'));
  
  }

  public function store(Request $request)
  {
    $this->authorize('create',Applicationreview::class);
    $this->validate($request, [
        //'name' => 'required|min:1|max:128',
        'title_en' => 'required|min:1|max:128',
        'title_bn' => 'required|min:1|max:128',
    ]);

    try {
      $application = DB::table('applications')->orderBy('id','DESC')->first();
      $data = $request->except('_token');
      $authUser = Auth::guard('admin')->user()->id;
      array_walk_recursive($data, function (&$val) {
          $val = trim($val);
          $val = is_string($val) && $val === '' ? null : $val;
      });

      $data['created_by'] = $authUser;

      if ($request->hasFile('dsign')) {
        //@unlink(storage_path('/app/public/' . $site_setting->dsign));
        $dsign = $request->file('dsign');
        $randNumber = rand(1, 999);
        $name = 'dsign-' . $authUser . '-' . time() . $randNumber . '.' . $dsign->getClientOriginalExtension();
        $year = date('Y/');
        $month = date('F/');
        $destinationPath = storage_path('app/public/application/' . $year . $month);
        $dsign->move($destinationPath, $name);
        $filePath = 'application/' . $year . $month;
        $data['dsign'] = $filePath . '' . $name;
      }

      // Get relational data
      $authData = Auth::guard('admin')->user()->load(['userType']);
      $area = Area::find($data['area_id']);
      $service = Service::find($data['service_id']);

      $data['service_type_id'] = $service->service_type_id;
      $data['category_id'] = $service->category_id;
      $data['association_id'] = $area->association_id;
      
      $vat = $area->vat;
      $govt_charge = $service->govt_charge;
      $service_charge = $service->service_charge;
      $vat_amount = (($govt_charge + $service_charge)*$vat)/100;


      $data['approval_id'] = 1;
      $data['vat'] = $vat;
      $data['govt_charge'] = $govt_charge;
      $data['service_charge'] = $service_charge;
      $data['total_charge'] = ($govt_charge + $service_charge + $vat_amount);

      if ($authData->userType->default_role > Admin::EmbassySuperAdmin) {
        $data['area_id'] = $authData->area_id;
      }elseif($authData->userType->default_role > Admin::EmbassyManager){
        $data['branch_id'] = $authData->branch_id;
      }

      // User Area
      $userCount = User::where(['email'=>$data['email']])->orWhere(['contact'=>$data['contact']])->count();
      
      if($userCount == 0){
        $user = User::orderBy('id','desc')->first();
        if ($user) {
          $data['code'] = $user->code + 1;
        } else {
          $data['code'] = 1;
        }
        
        $data['username'] = $data['contact'];
        $data['password'] = bcrypt($data['contact']);
        $user = User::create($data);
      }else{
        $user = User::where(['email'=>$data['email']])->orWhere(['contact'=>$data['contact']])->first();
      }
      $data['user_id'] = $user->id;
      // User Area

      if ($application) {
        $data['code'] = $application->code + 1;
      } else {
        $data['code'] = 1;
      }

      $application = Applicationreview::create($data);

      //Files Area
      foreach ($request['arraydata'] as $key => $arraydata) {
        if (@$arraydata['thumb']) {
          //@unlink(storage_path('/app/public/' . $site_setting->thumb));
          $thumb = $arraydata['thumb'];
          $randNumber = rand(1, 999);
          $name = 'thumb-' . $authUser . '-' . time() . $randNumber . '.' . $thumb->getClientOriginalExtension();
          $year = date('Y/');
          $month = date('F/');
          $destinationPath = storage_path('app/public/file/' . $year . $month);
          $thumb->move($destinationPath, $name);
          $filePath = 'file/' . $year . $month;
          $filedata['thumb'] = $filePath . '' . $name;
          $filedata['name'] = $arraydata['name'];
          $filedata['application_id'] = $application->id;
          $filedata['created_by'] = $authUser;
          File::create($filedata);
        }
      }
      //Files Area

    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }

    return redirect()->route('admin.applicationreview')->with([
                    'message' => __('admin.common.success'),
                    'alert-type' => 'success'
                ]);
  }

  public function edit(Request $request, $id)
  {
    $this->authorize('update',Applicationreview::class);
    $application = Applicationreview::with('association','area','branch','category','service','serviceType','user','file')->where(['id'=>$id])->first();
    if ( is_null($application) == true) {
      return back()->with([
        'error' => __('admin.common.error'),
        'alert-type' => 'error'
      ]);
    }

    $associations = Association::get();
    $areas = Area::utwd()->get();
    $branches = Branch::utwd()->get();
    $office_types = OfficeType::get();

    $categories = Category::get();
    $services = Service::get();
    $users = User::get();

    //Validation
    $authUser = Auth::guard('admin')->user()->load(['userType']);

    if($authUser->userType->default_role >= Admin::DEFAULT_ROLE_LIST[9]){
      $approvals = Approval::whereIn('id',[Admin::PENDING])->get();
    } elseif($authUser->userType->default_role >= Admin::DEFAULT_ROLE_LIST[8]){
      $approvals = Approval::whereIn('id',[Admin::PENDING,Admin::APPROVED,Admin::CANCEL])->get();
    } elseif($authUser->userType->default_role >= Admin::DEFAULT_ROLE_LIST[4]){
      $approvals = Approval::whereIn('id',[Admin::APPROVED,Admin::CANCEL,Admin::REJECTED,Admin::COMPLETED])->get();
    } else{
      $approvals = Approval::whereIn('id',[Admin::PENDING,Admin::APPROVED,Admin::CANCEL,Admin::REJECTED,Admin::COMPLETED])->get();
    }
    //Validation

    //dd( $approvals);
    //dd($application,$areas, $branches);

    return view(self::VIEW_PATH . 'add_edit', compact('application','associations','areas','branches','office_types','categories','services','users','approvals'));
  }

  public function update(Request $request, $id)
  {
    $this->authorize('update',Applicationreview::class);
    //dd($request->all());
    $this->validate($request, [
      //'name' => 'required|min:1|max:128',
      'title_en' => 'required|min:1|max:128',
      'title_bn' => 'required|min:1|max:128',
    ]);

    try {
      $application = Applicationreview::where(['id'=>$id])->first();
      if ( is_null($application) == true) {
        return back()->with([
          'error' => __('admin.common.error'),
          'alert-type' => 'error'
        ]);
      }
      $data = $request->except('_token');
      $authUser = Auth::guard('admin')->user()->id;
      array_walk_recursive($data, function (&$val) {
          $val = trim($val);
          $val = is_string($val) && $val === '' ? null : $val;
      });

      $data['updated_by'] = $authUser;

      if ($request->hasFile('dsign')) {
        @unlink(storage_path('app/public/application/' . $application->dsign));
        $dsign = $request->file('dsign');
        $randNumber = rand(1, 999);
        $name = 'dsign-' . $authUser . '-' . time() . $randNumber . '.' . $dsign->getClientOriginalExtension();
        $year = date('Y/');
        $month = date('F/');
        $destinationPath = storage_path('app/public/application/' . $year . $month);
        $dsign->move($destinationPath, $name);
        $filePath = 'application/' . $year . $month;
        $data['dsign'] = $filePath . '' . $name;
      }
      Applicationreview::find($id)->update($data);

      //Files Area
      foreach ($request['arraydata'] as $key => $arraydata) {
        //dd($arraydata);
        if (@$arraydata['id']) {
          $id = $arraydata['id'];
          $filedata['name'] = $arraydata['name'];

          if (@$arraydata['thumb']) {
            //@unlink(storage_path('/app/public/' . $site_setting->thumb));
            $thumb = $arraydata['thumb'];
            $randNumber = rand(1, 999);
            $name = 'thumb-' . $authUser . '-' . time() . $randNumber . '.' . $thumb->getClientOriginalExtension();
            $year = date('Y/');
            $month = date('F/');
            $destinationPath = storage_path('app/public/file/' . $year . $month);
            $thumb->move($destinationPath, $name);
            $filePath = 'file/' . $year . $month;
            $filedata['thumb'] = $filePath . '' . $name;
          }
          File::find($id)->update($filedata);
        } else {
          if (@$arraydata['thumb']) {
            //@unlink(storage_path('/app/public/' . $site_setting->thumb));
            $thumb = $arraydata['thumb'];
            $randNumber = rand(1, 999);
            $name = 'thumb-' . $authUser . '-' . time() . $randNumber . '.' . $thumb->getClientOriginalExtension();
            $year = date('Y/');
            $month = date('F/');
            $destinationPath = storage_path('app/public/file/' . $year . $month);
            $thumb->move($destinationPath, $name);
            $filePath = 'file/' . $year . $month;
            $filedata['thumb'] = $filePath . '' . $name;
            //$filedata['name'] = $arraydata['name'];
            $filedata['application_id'] = $application->id;
            $filedata['created_by'] = $authUser;
  
            $filedata['name'] = $arraydata['name'];
            File::create($filedata);
          }
        }
        
      }
      //Files Area
    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }
    return redirect()->route('admin.applicationreview')->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);
  }

  public function delete(Request $request, $id, $sid = 0)
  {    
    $this->authorize('delete',Applicationreview::class);
    $application = Applicationreview::with('file')->find($id);
    if ( is_null($application) == true) {
      return back()->with([
        'error' => __('admin.common.error'),
        'alert-type' => 'error'
      ]);
    }

    try {
      $user = User::find($application->user_id);
      
      if ($sid==false) {
        $application->status = false;
        $application->save();
      } else {
        $user->delete();
        if ( count($application->file) > 0 ) {
          foreach ($application->file as $key => $file) {
            @unlink(storage_path('/app/public/' . $file->thumb));
          }
        }

        @unlink(storage_path('/app/public/' . $application->dsign));
        $application->delete();
      }
    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }
    
    return redirect()->route('admin.applicationreview')->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);
  }

  public function delete_file(Request $request, $id, $sid = 0)
  {   
    $this->authorize('delete',Applicationreview::class);
    $file = File::find($id);
    if ( is_null($file) == true) {
      return back()->with([
        'error' => __('admin.common.error'),
        'alert-type' => 'error'
      ]);
    }
    try {
      if ($sid==false) {
        @unlink(storage_path('/app/public/' . $file->thumb));
        $file->delete();
      } else {
        
        @unlink(storage_path('/app/public/' . $file->thumb));
        $file->delete();
      }
    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }
    
    return back()->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);
    
    return redirect()->route('admin.applicationreview.create')->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);
  }


  public function edit_approval(Request $request, $id)
  {
    $this->authorize('update_approval',Applicationreview::class);
    $application = Applicationreview::with('association','area','branch','category','service','serviceType','user','file')->where(['id'=>$id])->first();
    if ( is_null($application) == true) {
      return back()->with([
        'error' => __('admin.common.error'),
        'alert-type' => 'error'
      ]);
    }

    $associations = Association::get();
    $areas = Area::utwd()->get();
    $branches = Branch::utwd()->get();
    $office_types = OfficeType::get();

    $categories = Category::get();
    $services = Service::get();
    $users = User::get();

    //Validation
    $authUser = Auth::guard('admin')->user()->load(['userType']);

    if($authUser->userType->default_role >= Admin::DEFAULT_ROLE_LIST[9]){
      $approvals = Approval::whereIn('id',[Admin::PENDING])->get();
    } elseif($authUser->userType->default_role >= Admin::DEFAULT_ROLE_LIST[8]){
      $approvals = Approval::whereIn('id',[Admin::PENDING,Admin::APPROVED,Admin::CANCEL])->get();
    } elseif($authUser->userType->default_role >= Admin::DEFAULT_ROLE_LIST[4]){
      $approvals = Approval::whereIn('id',[Admin::APPROVED,Admin::CANCEL,Admin::REJECTED,Admin::COMPLETED])->get();
    } else{
      $approvals = Approval::whereIn('id',[Admin::PENDING,Admin::APPROVED,Admin::CANCEL,Admin::REJECTED,Admin::COMPLETED])->get();
    }
    //Validation

    //dd( $approvals);
    //dd($application,$areas, $branches);

    return view(self::VIEW_PATH . 'add_edit_approval', compact('application','associations','areas','branches','office_types','categories','services','users','approvals'));
  }

  public function update_approval(Request $request, $id)
  {
    $this->authorize('update_approval',Applicationreview::class);
    //dd($request->all());
    $this->validate($request, [
      'approval_id' => 'required',
    ]);

    try {
      $application = Applicationreview::where(['id'=>$id])->first();
      if ( is_null($application) == true) {
        return back()->with([
          'error' => __('admin.common.error'),
          'alert-type' => 'error'
        ]);
      }
      $data = $request->except('_token');
      $authUser = Auth::guard('admin')->user()->id;
      array_walk_recursive($data, function (&$val) {
          $val = trim($val);
          $val = is_string($val) && $val === '' ? null : $val;
      });

      $data['updated_by'] = $authUser;
      Applicationreview::find($id)->update($data);

    } catch (\Throwable $exception) {
      return back()->with([
        //'error' => __('admin.common.error'),
        'error' => $exception->getMessage(),
        'alert-type' => 'error'
      ]);
    }
    return redirect()->route('admin.applicationreview')->with([
      'message' => __('admin.common.success'),
      'alert-type' => 'success'
    ]);
  }

}
