<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\Sales;
use App\Models\Country;

use App\Models\Apps;

class WordpressDataController extends Controller
{
    //

    public function index()
    {
        dd('index');
    }
 
    public function show($id)
    {
        dd('show');
    }
 
    public function store(Request $request)
    {
        dd('store');
    }
 
    public function update(Request $request, $id)
    {
        dd('update');
    }
 
    public function destroy($id)
    {
        dd('destroy');
    }

    public function getDatafrom (Request $req){

        $account = new Account();

        $account->name = $req->last_name.', '.$req->first_name;
        $account->account_phone = $req->phone;
        $account->email = $req->email;
        $account->google_drive  = $req->google_drive;
        $account->account_type_id = $req->account_type;
        $newDate = date("Y-m-d", strtotime($req->birth_day));
        $account->bday =  $newDate.' 00:00:00';
        $account->registration_status = $req->registration_status;
        $account->tax_id_type = $req->tax_id_type;
        $newDate = date("Y-m-d", strtotime($req->status_date));
        $account->status_date = $newDate.' 00:00:00';
        $account->tax_id = $req->tax_id;
        $account->tax_filing_code = $req->tax_filing_code;
           
        $country_id = Country::where('name', '=', $req->country)->orWhere('code', '=',  $req->country)->first()->id;
        $account->country_id = $country_id??null;

        $GoogleDrive = new GoogleDriveController;
        
        $folder =  $GoogleDrive->create_folder($account->name);
        
        if(!empty($folder) && !empty($folder['id'])){
            $account->folder_id = $folder['id'];
        }
        
        if($account->save()){
            $sale = new Sales();
            $sale->account_id = $account->id;
            $sale->periodical_one_off = 2;
            $newDate = date("Y-m-d", strtotime($req->start_date));
            $sale->start_date = $newDate;
            $sale->until_date = $req->until_date??null;
            $sale->currency = $req->currency;
            $sale->quantity = $req->quantity??1;
            $sale->comment = $req->comment;
            if($sale->save()){
                return 'success';
            }
        }

        return [$req,'some error'];

    }

}
