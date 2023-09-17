<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\Sales;

use App\Models\Apps;

class ShopifyZapierController extends Controller
{
    
    public $ziperToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9';

    public function getDatafrom (Request $req){
        
        if( $req->input('zapierToken') != $this->ziperToken ){
            return response()->json(['code' => 401, 'unauthorise']);
        }
        
                 $token = $req->header('Authorization');
        return response()->json(['code' => 200,  'data' => $req->input(), 'host' => $req->header('Host'), 'token'=> $token]);


        // {
        //     "title": "test",
        //     "first_name": "first_name",
        //     "last_name": "last_name",
        //     "company": "company",
        //     "phone": "phone",
        //     "email": "email",
        //     "description": "description",
        //     "industry": "industry",
        //     "project_details": "project_details",
        //     "expected_annual_turnover": "expected_annual_turnover",
        //     "profit_expectation": "profit_expectation",
        //     "interested_design": "interested_design",
        //     "desired_country": "desired_country",
        //     "describe_company_profits": "describe_company_profits",
        //     "current_income_tax_subject": "current_income_tax_subject",
        //     "willing_relocate": "willing_relocate",
        //     "token": "gUhfe%WC@95dX)XEj&J+E*aXcgAz#7HP"
        // }


        $account = new Account();
        $account->account_phone = $req->phone;
        $account->email = $req->email;
        $account->name = $req->last_name.', '.$req->first_name;
        
        $GoogleDrive = new GoogleDriveController;
        
        $folder =  $GoogleDrive->create_folder($account->name);
        
        if(!empty($folder) && !empty($folder['id'])){
            $account->folder_id = $folder['id'];
        }
        
        if($account->save()){
            $sale = new Sales();
            $sale->account_id = $account->id;
            if($sale->save()){
                return 'success';
            }
        }

        return [$req,'some error'];

    }
}
