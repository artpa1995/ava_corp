<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowingCompany;
use Auth;

class CompanyFollowwingController extends Controller
{
    //

    public function following_company (Request $req){

        $url = url()->previous();
        $contact_id = $req->input('contact_id');
        $page = $req->input('page');
        $FollowingCompany =  FollowingCompany::where('contact_id', '=', $contact_id)->where($page, '=', $req->input('company_id'))->get()->first();

        if(empty($FollowingCompany)){
            $FollowingCompany = new FollowingCompany();

            $FollowingCompany->user_id = Auth::user()->id;
            $FollowingCompany->company_id = $req->input('company_id');
            $FollowingCompany->account_id = $req->input('account_id');
            $FollowingCompany->contact_id = $contact_id;
    
            if ($FollowingCompany->save()) {
                return redirect()->to($url)->with('success',  'New Following Created');
            }
        }

        return  redirect()->to($url)->with('danger', "This company following this contact");

    }

    public function delete_following_company($id){
        $url = url()->previous();
        $FollowingCompany = FollowingCompany::find($id);
        if(empty($FollowingCompany)){
            return redirect()->to($url)->with('danger',  'Not Found');
        }
        if($FollowingCompany->delete()){
            return redirect()->to($url)->with('success',  'Removed');
        }
    }
}
