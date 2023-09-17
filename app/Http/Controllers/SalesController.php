<?php

namespace App\Http\Controllers;
use App\Models\Sales;
use App\Models\User;
use Auth;

use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function new_sales(Request $req) {
        $sale = new Sales();

        $page_id = $req->input('page_id');
        $page_type = $req->input('page_type');
        $page = $page_type.'_id';

        $sale->user_id = Auth::user()->id;       
        $sale->{$page} =  $page_id;
        $sale->quantity = $req->input('quantity');
        $sale->start_date = $req->input('start_date');
        $sale->until_date = $req->input('until_date');
        $sale->price_calculated = $req->input('price_calculated');
        $sale->for_periods = $req->input('for_periods');
        $sale->for_counts = $req->input('for_counts');
        $sale->currency = $req->input('currency');
        $sale->overall_price = $req->input('overall_price');
        $sale->price_per_period = $req->input('price_per_period');
        $sale->service_id = $req->input('service_configurations_id');
        $sale->set_price_time_spent = $req->input('set_price_time_spent');
        $sale->periodical_one_off = $req->input('periodical_one_off');
        $sale->renew_indefinitely_renew_until = $req->input('renew_indefinitely_renew_until');
        $sale->renew_until_periods = $req->input('renew_until_periods');
        $sale->comment = $req->input('comment');

        if($req->input('periodical_one_off') == 2){
            $sale->for_counts = null; 
            $sale->for_periods = null;
        }

        // if($req->input('set_price_time_spent') == 2){
        //     $sale->currency = null;
        //     $sale->overall_price = null;
        //     $sale->price_per_period = null;
        // }

        $url = url()->previous();
        if($sale->save()){
            return redirect()->to($url)->with('success',  'Sales is created');
        }
        return redirect()->to($url)->with('danger',  'Sales some error');

    }

    public function edit_sales(Request $req) {

        $url = url()->previous();
        $sale_id = $req->input('sale_id');
        if(!$sale_id){
            return redirect()->to($url)->with('danger',  'Sales some error');
        }
        $sale = Sales::find($sale_id);
        if(empty($sale)){
            return redirect()->to($url)->with('danger',  'Sales not found ');
        }

        $page_id = $req->input('page_id');
        $page_type = $req->input('page_type');
        $page = $page_type.'_id';
        $sale->user_id = Auth::user()->id;       
        $sale->{$page} =  $page_id;
        $sale->quantity = $req->input('quantity');
        $sale->start_date = $req->input('start_date');
        $sale->until_date = $req->input('until_date');
        $sale->price_calculated = $req->input('price_calculated');
        $sale->for_periods = $req->input('for_periods');
        $sale->for_counts = $req->input('for_counts');
        $sale->currency = $req->input('currency');
        $sale->overall_price = $req->input('overall_price');
        $sale->price_per_period = $req->input('price_per_period');
        $sale->service_id = $req->input('service_configurations_id');
        $sale->set_price_time_spent = $req->input('set_price_time_spent');
        $sale->periodical_one_off = $req->input('periodical_one_off');
        $sale->renew_indefinitely_renew_until = $req->input('renew_indefinitely_renew_until');
        $sale->renew_until_periods = $req->input('renew_until_periods');

        if($req->input('periodical_one_off') == 2){
            $sale->for_counts = null; 
            $sale->for_periods = null;
        }
        // if($req->input('set_price_time_spent') == 2){
        //     $sale->currency = null;
        //     $sale->overall_price = null;
        //     $sale->price_per_period = null;
        // }

        if($sale->save()){
            return redirect()->to($url)->with('success',  'Sales is edited');
        }
        return redirect()->to($url)->with('danger',  'Sales some error');
    
    }

    public function delete_sales($id) {
        $url = url()->previous();
        $sale = Sales::find($id);

        if(empty($sale)){
            return redirect()->to($url)->with('danger', "Not Found");
        }
        if($sale->delete()){
            return redirect()->to($url)->with('success',' Sale - Removed');
        }
    
    }
}
