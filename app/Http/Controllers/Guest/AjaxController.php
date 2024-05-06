<?php
namespace App\Http\Controllers\Guest;

use App;
use App\Models\Unit;
use App\Models\User;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Nursery;
use App\Models\Product;

use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Models\TrackingDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Association;
use App\Models\BranchUnit;
use App\Models\Thana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AjaxController extends Controller
{
    
    public function getPresident($id)
    {
        if($id){
            $branch = Branch::find($id);
            return $presidents = Admin::where('area_id',$branch->area_id)->where(['user_type_id'=>Admin::P])->get();
        }
        return [];
        
    }
    
    public function getVicePresident($id)
    {
        if($id){
            return $branch_units = Admin::where('branch_id',$id)->where(['user_type_id'=>Admin::VP])->get();
        }
        return [];
        
    }
    
    public function getCaliph($id)
    {
        if($id){
            return $branch_units = Admin::where('branch_id',$id)->where(['user_type_id'=>Admin::CA])->get();
        }
        return [];
        
    }
    
    public function getBranchUnit($id)
    {
        if($id){
            return $branch_units = BranchUnit::where('branch_id',$id)->get();
        }
        return [];
        
    }
    
    public function getDivision($id)
    {
        if($id){
            return $divisions = Division::where('state_id',$id)->get();
        }
        return [];
        
    }
    
    public function getDsitrict($id)
    {
        if($id){
            return $districts = District::where('division_id',$id)->get();
        }
        return [];
        
    }
    
    public function getArea($id)
    {
        if($id){
            return $associations = Area::where('association_id',$id)->get();
        }
        return [];
        
    }
    
    public function getBranchByArea($id)
    {
        $authUser = Auth::guard('admin')->user()->load(['userType']);
        if($id){
            if ($authUser->userType->default_role == Admin::ESCOperator) {
                return $branches = Branch::where(['id'=>$authUser->branch_id])->get();
            } else {
                return $branches = Branch::where('area_id',$id)->get();
            }
        }
        return [];
        
    }
    
    public function getUpazila($id)
    {
        if ($id) {
            return $upazilas = Upazila::where('district_id',$id)->get();
        }
        return [];
    }
    
    public function getThana($id)
    {
        if ($id) {
            return $thanas = Thana::where('district_id',$id)->get();
        }
        return [];
    }
    
    // public function getProduct($id = 0)
    // {
    //     if ($id > 0) {
    //         return $products = Product::with('size','color','age','unit','category')->where('id',$id)->get();
    //     }
    //     return [];
    // }
    
    // public function getProducts($id = 0)
    // {
    //     if ($id > 0) {
    //         return $products = Product::with('size','color','age','unit','category')->where('category_id',$id)->get();
    //     }
    //     return [];
    // }
    
    // public function getUnit($id = 0)
    // {
    //     if ($id) {
    //         return $products = Unit::where('id',$id)->get();
    //     }
    //     return [];
    // }
    
    public function getUpazilaSelf($id = 0)
    {
        if ($id) {
            return $upazila = Upazila::where('id',$id)->get();
        }
        return [];
    }
    
    // public function getNursery($id = 0)
    // {
    //     if ($id) {
    //         $nursery = Nursery::find($id);
    //         $division_id = $nursery->division_id;

    //         return $division = Division::find($division_id);
    //     }

    //     return \response()->json(null);
    // }
    
    // public function getNursery1($id = 0)
    // {
    //     if ($id) {
    //         return $nurseries = Nursery::where(['upazila_id'=>$id])->get();
    //     }

    //     return [];
    // }
    
    public function getUsers()
    {
        $query = User::get();
        return $users = json_decode(json_encode($query), True);
        //return \response()->json($users);
    }
    
    public function getServiceDataLoad($dv_id, $qr_code,$ids="[]")
    {
        $authUser = Auth::guard('admin')->user()->load(['userType']);
        $default_role = $authUser->userType->default_role;
        
        $service_details = ServiceDetail::with('service')->where(['code'=>$qr_code])->first();
        //validetaion
        $destination_count = TrackingDetail::where(['service_detail_code'=>$qr_code, 'load_status' => 1, 'destination_branch_id' =>$service_details->service->to_branch_id])->count();
        
        // if ($destination_count > 0) {
        //     return 'delivered';
        // }
        //validetaion
        if (@$ids == "[]") {
            $ids = [];
        }else{
            @$ids = json_decode(@$ids, true);
        }

        if ($default_role <= Admin::AD) {
            $dv_id = $dv_id;
        } else {
            $dv_id = $dv_id;
            //$dv_id = $authUser->branch_id;
        }


        $count = ServiceDetail::where(['code'=>$qr_code])->count();
        //dd($dv_id, $qr_code, count(@$ids));
        if ($count > 0) {
            $service_detail = ServiceDetail::with('service')->where(['code'=>$qr_code])->first();
            if (count($ids) > 0) {
                $in_arr = in_array($service_detail->id, $ids);
                if (!$in_arr) {
                    $toBranch_id = $service_detail->service->to_branch_id;
                    $arrs = [$toBranch_id,149,177];
                    $in_ar = in_array($dv_id,$arrs);
                    if (!$in_ar) {
                        return 'false';
                    }else{
                        return $service_detail;
                    }
                }else{
                    return false;
                }
            }else{
                $toBranch_id = $service_detail->service->to_branch_id;
                $arrs = [$toBranch_id,149,177];
                $in_ar = in_array($dv_id,$arrs);
                if (!$in_ar) {
                    return 'false';
                }else{
                    return $service_detail;
                }
            }
        }else{
            return false;
        }
        
        
    }
    
    
    public function getServiceDataUnload($dv_id,$vehicle_id,$qr_code,$ids="[]")
    {
        $authUser = Auth::guard('admin')->user()->load(['userType']);
        $default_role = $authUser->userType->default_role;
        if (@$ids == "[]") {
            $ids = [];
        }else{
            @$ids = json_decode(@$ids, true);
        }

        if ($default_role <= Admin::AD) {
            $dv_id = $dv_id;
        } else {
            //$dv_id = $authUser->branch_id;
            $dv_id = $dv_id;
        }
        
        //dd($dv_id,$vehicle_id,$qr_code,$ids);
        //dd($dv_id,$vehicle_id,$qr_code,$ids, $load_count, $branch_count);
        

        // $branch_count = TrackingDetail::where(['service_detail_code'=>$qr_code, 'to_branch_id' => $dv_id])->count();
        // if ($branch_count == 0) {
        //     return 'branch_false';
        // }

        // $load_count = TrackingDetail::where(['service_detail_code'=>$qr_code, 'load_status' => 1])->count();
        // if ($load_count == 0) {
        //     return 'loading_false';
        // }
        
        // $vehicle_count = TrackingDetail::where(['service_detail_code'=>$qr_code, 'vehicle_id' => $vehicle_id])->count();
        // if ($vehicle_count == 0) {
        //     return 'vehicle_false';
        // }
        
        //$loading_count = TrackingDetail::where(['service_detail_code'=>$qr_code, 'load_status'=>1, 'vehicle_id' => $vehicle_id,'to_branch_id' => $authUser->branch_id])->count();
        
        if (true) {
            $count = ServiceDetail::where(['code'=>$qr_code])->count();
            if ($count > 0) {
                $service_detail = ServiceDetail::with('service')->where(['code'=>$qr_code])->first();
                if (count($ids) > 0) {
                    $in_arr = in_array($service_detail->id, $ids);
                    if (!$in_arr) {
                        $toBranch_id = $service_detail->service->to_branch_id;
                        $arrs = [$toBranch_id,149,177];
                        $in_ar = in_array($dv_id,$arrs);
                        if (!$in_ar) {
                            return 'false';
                        }else{
                            return $service_detail;
                        }
                    }else{
                        return false;
                    }
                }else{
                    $toBranch_id = $service_detail->service->to_branch_id;
                    $arrs = [$toBranch_id,149,177];
                    $in_ar = in_array($dv_id,$arrs);
                    if (!$in_ar) {
                        return 'false';
                    }else{
                        return $service_detail;
                    }
                }
            }else{
                return false;
            }
        } else {
            return 'loading_false';
        }
        
    }
    
    public function getUsersContact($contact)
    {
        $users = User::select('contact')->where("contact", "LIKE", "%{$contact}%")->take(10)->get();
        //$users = json_decode(json_encode($query), True);
        $data = [];
        foreach ($users as $key => $user) {
            $data[] = $user->contact;
        }
        return $data;
    }
    
    public function getUsersName($contact)
    {
        $query = User::where("contact",$contact)->first();
        $users = json_decode(json_encode($query), True);
        return \response()->json($users);
    }
    
    public function getBranches($id)
    {   
        $branches = [];
        $count = Branch::where(['district_id'=>$id])->count();
        if ($count > 0) {
            $branches = Branch::where(['district_id'=>$id])->get();
        }else{
            $branches = [];
        }
        return \response()->json($branches);
    }
    
    public function getBranch($branch_id)
    {   
        //$count = Branch::where(['id'=>$branch_id])->count();
        Session::put(['branch_id'=>$branch_id]);
        return \response()->json($branch_id);

    }
    
    public function getCnNumber($service_type_id = 0)
    {   
        if ($service_type_id > 0) {
            # code...
            $authUser = Auth::guard('admin')->user()->load(['userType']);
            $service_type_id = $service_type_id;
            $branch_id = $authUser->branch_id;
            $query = DB::table('service_types as t1')
                    ->select(
                        // DB::raw("(SELECT(CASE WHEN SUM(t2.quantity) IS NULL THEN 0 ELSE SUM(t2.quantity) END) FROM cn_order_details as t2 
                        // WHERE t2.service_type_id = t1.id and t2.approved = 1 and t2.branch_id = {$branch_id})  as cn_quantity"),

                        // DB::raw("(SELECT(CASE WHEN SUM(t3.count) IS NULL THEN 0 ELSE SUM(t3.count) END) FROM services as t3 
                        // WHERE t3.service_type_id = t1.id and t3.from_branch_id = {$branch_id})  as service_quantity"),
                        
                        DB::raw("((SELECT(CASE WHEN SUM(t2.quantity) IS NULL THEN 0 ELSE SUM(t2.quantity) END) FROM cn_order_details as t2 
                        WHERE t2.service_type_id = t1.id and t2.approved = 1 and t2.branch_id = {$branch_id})) - ((SELECT(CASE WHEN SUM(t3.count) IS NULL THEN 0 ELSE SUM(t3.count) END) FROM services as t3 
                        WHERE t3.service_type_id = t1.id and t3.from_branch_id = {$branch_id})) as cn_no"),
                    )
            ->where('t1.id',$service_type_id)
            ->first();
            $cn_orders = json_decode(json_encode($query), True);
            return \response()->json($cn_orders);
        }else{
            $cn_orders = null;
            return \response()->json($cn_orders);
        }
        
    }
    
    public function getCnNumberForAdmin($service_type_id = 0, $branch_id)
    {   
        if ($service_type_id > 0) {
            # code...
            
            $query = DB::table('service_types as t1')
                    ->select(
                        // DB::raw("(SELECT(CASE WHEN SUM(t2.quantity) IS NULL THEN 0 ELSE SUM(t2.quantity) END) FROM cn_order_details as t2 
                        // WHERE t2.service_type_id = t1.id and t2.approved = 1 and t2.branch_id = {$branch_id})  as cn_quantity"),

                        // DB::raw("(SELECT(CASE WHEN SUM(t3.count) IS NULL THEN 0 ELSE SUM(t3.count) END) FROM services as t3 
                        // WHERE t3.service_type_id = t1.id and t3.from_branch_id = {$branch_id})  as service_quantity"),
                        
                        DB::raw("((SELECT(CASE WHEN SUM(t2.quantity) IS NULL THEN 0 ELSE SUM(t2.quantity) END) FROM cn_order_details as t2 
                        WHERE t2.service_type_id = t1.id and t2.approved = 1 and t2.branch_id = {$branch_id})) - ((SELECT(CASE WHEN SUM(t3.count) IS NULL THEN 0 ELSE SUM(t3.count) END) FROM services as t3 
                        WHERE t3.service_type_id = t1.id and t3.from_branch_id = {$branch_id})) as cn_no"),
                    )
            ->where('t1.id',$service_type_id)
            ->first();
            $cn_orders = json_decode(json_encode($query), True);
            return \response()->json($cn_orders);
        }else{
            $cn_orders = null;
            return \response()->json($cn_orders);
        }
    }
}