<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyType;
use App\Models\IndustriesType;
use App\Models\CompanyOrganization;
use App\Models\User;
use Auth;

class CompanyOrganizationsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        return view('user.company_organization.company_organizations', [
            'company_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'company_organizations' => CompanyOrganization::where('user_id', $id)->get(),
            'all_company_organizations' =>CompanyOrganization::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
            ]);
    }

    public function add_account(Request $req){

        $data = new CompanyOrganization();

        $data->name = $req->input('name');
        $data->user_id = Auth::user()->id;
        $data->owner_id = $req->input('owner_id');
        $data->company_id = $req->input('company_id');
        $data->parent_id = $req->input('parent_id') !== "Select Parent Company" ? $req->input('parent_id') : 0 ;
        $data->industry_id = $req->input('industry_id');
        $data->company_phone = $req->input('company_phone');
        $data->website = $req->input('website');
        $data->additional_phone = $req->input('additional_phone');
        $data->employees = $req->input('employees');
        $data->description = $req->input('description');
        $data->address_1_street = $req->input('address_1_street');
        $data->address_1_country = $req->input('address_1_country');
        $data->address_1_city = $req->input('address_1_city');
        $data->address_1_state = $req->input('address_1_state');
        $data->address_1_zip_code = $req->input('address_1_zip_code');
        $data->address_2_street = $req->input('address_2_street');
        $data->address_2_country = $req->input('address_2_country');
        $data->address_2_city = $req->input('address_2_city');
        $data->address_2_state = $req->input('address_2_state');
        $data->address_2_zip_code = $req->input('address_2_zip_code');

        if($data->save()){
            return redirect()->route('company-organizations')->with('success', $req->input('name').' - Add');
        }
    }

    public function edit_company(Request $req, $id){
        $company_organization = CompanyOrganization::whereId($id)->withCount('contacts')->first();

        if(empty($company_organization)){
            return redirect()->route('company-organizations')->with('danger', "Not Found");
        }

        if ($_POST){
            if(Auth::user()->id) {
                $company_organization->name = $req->input('name');
                $company_organization->user_id = Auth::user()->id;
                $company_organization->owner_id = $req->input('owner_id');
                $company_organization->company_id = $req->input('company_id');
                $company_organization->parent_id = $req->input('parent_id') !== "Select Parent Company" ? $req->input('parent_id') : 0;
                $company_organization->industry_id = $req->input('industry_id');
                $company_organization->company_phone = $req->input('company_phone');
                $company_organization->website = $req->input('website');
                $company_organization->additional_phone = $req->input('additional_phone');
                $company_organization->employees = $req->input('employees');
                $company_organization->description = $req->input('description');
                $company_organization->address_1_street = $req->input('address_1_street');
                $company_organization->address_1_country = $req->input('address_1_country');
                $company_organization->address_1_city = $req->input('address_1_city');
                $company_organization->address_1_state = $req->input('address_1_state');
                $company_organization->address_1_zip_code = $req->input('address_1_zip_code');
                $company_organization->address_2_street = $req->input('address_2_street');
                $company_organization->address_2_country = $req->input('address_2_country');
                $company_organization->address_2_city = $req->input('address_2_city');
                $company_organization->address_2_state = $req->input('address_2_state');
                $company_organization->address_2_zip_code = $req->input('address_2_zip_code');

                if ($company_organization->save()) {
                    return redirect()->route('edit_company_organization', [$id])->with('success', $req->input('name') . ' - Edit');
                }
            }
        }

        return view('user.company_organization.edit_company', [
            'company_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'company_organization' => $company_organization,
            'all_company_organizations' =>CompanyOrganization::get(['id', 'name']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
        ]);
    }

    public function delete_company($id){
        $company_organization = CompanyOrganization::find($id);
        if(empty($company_organization)){
            return redirect()->route('company-organizations')->with('danger', "Not Found");
        }
        if($company_organization->delete()){
            return redirect()->route('company-organizations')->with('success', $company_organization->name.' - Remove');
        }
    }


    public function get_parent_account_ajax (Request $req) {
        if($req->ajax()){
            $company_organization = CompanyOrganization::query()->where('name', 'like', '%'. $req->parent_account .'%')->get();
            return  $company_organization;
        }
    }
}
