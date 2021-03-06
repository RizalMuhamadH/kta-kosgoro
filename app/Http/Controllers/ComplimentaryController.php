<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Provinces;
use App\Models\SubDistricts;
use App\Models\User;
use App\Models\Villages;
use Illuminate\Http\Request;

class ComplimentaryController extends Controller
{
    public function getProvince(Request $request){
        $result = array();
        $tmp_province = Provinces::where('name','ilike','%'.$request->keywords.'%')->get();
        if(isset($request->cms)){
            foreach($tmp_province as $row){
                $result[] = ['id'   => $row->id, 'text'   =>  $row->name];
            }
            return response()->json($result,200);
        }else{
            return response($tmp_province, 200);
        }
    }

    public function getDistrict(Request $request){
        $result = array();
        $tmp_district = Districts::where('province_id',$request->province_id)->where('name','ilike','%'.$request->keywords.'%')->get();
        if(isset($request->cms)){
            foreach($tmp_district as $row){
                $result[] = ['id'   => $row->id, 'text'   =>  $row->name];
            }
            return response()->json($result,200);
        }else{
            return response($tmp_district, 200);
        }
    }

    public function getSubDistrict(Request $request){
        $result = array();
        $tmp_sub_district = SubDistricts::where('district_id',$request->district_id)->where('name','ilike','%'.$request->keywords.'%')->get();
        if(isset($request->cms)){
            foreach($tmp_sub_district as $row){
                $result[] = ['id'   => $row->id, 'text'   =>  $row->name];
            }
            return response()->json($result,200);
        }else{
            return response($tmp_sub_district, 200);
        }
    }

    public function getVillage(Request $request){
        $result = array();
        $tmp_vilalges = Villages::where('sub_district_id',$request->sub_district_id)->where('name','ilike','%'.$request->keywords.'%')->get();
        if(isset($request->cms)){
            foreach($tmp_vilalges as $row){
                $result[] = ['id'   => $row->id, 'text'   =>  $row->name];
            }
            return response()->json($result,200);
        }else{
            return response($tmp_vilalges, 200);
        }
    }

    public function getCountDashboard(){
        $data['count_admin']            = User::where('position_id','2')->count();
        $data['count_unverified_user']  = User::where('status','0')->count();
        $data['count_verified_user']    = User::where('status','1')->count();
        $data['count_blocked_user']     = User::where('status','2')->count();
        return response()->json($data,200);
    }


}
