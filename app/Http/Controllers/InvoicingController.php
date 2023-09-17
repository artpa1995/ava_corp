<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\Company;
use App\Models\Services;
use App\Models\Sales;
use DataTables;
use App\Models\User;

class InvoicingController extends Controller
{

    public $months =  array(
       '01' => 'January',
       '02' => 'February',
       '03' => 'March',
       '04' => 'April',
       '05' => 'May',
       '06' => 'June',
       '07' => 'July ',
       '08' => 'August',
       '09' => 'September',
       '10' => 'October',
       '11' => 'November',
       '12' => 'December',
    );

    public function invoicings(){

        if(!empty($by) && $by == 'Projected-Revenues'){

        }
        $url = url()->previous();
        return redirect()->to($url);

        return view('user.invoicings.index', [

            ]);
    }

    public function projected_revenues(){

        $next_momnth = (new \DateTime('first day of next month'))->format('Y-m-d');
        $next_year = date('Y-m-d', strtotime("+12 months $next_momnth"));
        $date = new \DateTime('now');
        $date->modify('last day of this month');
        $last_day_this_month = $date->format('Y-m-d');

        $sales_filters_dates1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
        ->where('periodical_one_off', '=', 1)
        ->distinct('until_date')
        ->orderBy('until_date', 'ASC')
        ->pluck('until_date')->toArray();

        $sales_filters_dates2 = Sales::where('until_date', '>', $next_momnth)
        ->where('until_date', '<', $next_year)
        ->where('periodical_one_off', '=', 1)
        ->distinct('until_date')
        ->orderBy('until_date', 'ASC')
        ->pluck('until_date')->toArray();

        $sales_filters_dates = array_merge($sales_filters_dates1, $sales_filters_dates2);

        $sales_filters_dates_arrary = [];
        // if($sales_filters_dates1){
        //     $year = date('Y');
        //     $this_month =  date('m');

        //     $sales_filters_dates_arrary[] =  $year . '-' . $this_month;
        // }
        
        foreach($sales_filters_dates as $sales_filters_date){
      
            $year = substr($sales_filters_date,0,4);
            $month  = $sales_filters_date[5].$sales_filters_date[6];

            $last_day_prev = date('t', strtotime("$year-$month-01"));
            $last_month_day = $sales_filters_date[8].$sales_filters_date[9];

            $valid_date = substr($sales_filters_date,0,7);

            if(($last_day_prev  == $last_month_day) ){

                $new_month  = intval( $month)+1;
                if(( intval( $month)+1) <10){
                    $new_month = '0'.$new_month;
                }
                if((intval( $month)) == 12){
                    $year = intval( $year)+1;
                    $new_month  = '01';
                }
                $valid_date = $year.'-'.$new_month ;
            }

            if(!in_array($valid_date, $sales_filters_dates_arrary)){
                $sales_filters_dates_arrary[] = $valid_date;
            }
        }

        $sales1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
        ->where('periodical_one_off', '=', 1)
        ->orderBy('until_date', 'ASC')
        ->with('services:id,title')
        ->with('account:id,name')
        ->with('company:id,name,account_id')
        ->get()->toArray();

        $sales2 = Sales::where('until_date', '>', $next_momnth)
        ->where('until_date', '<', $next_year)
        ->where('periodical_one_off', '=', 1)
        ->orderBy('until_date', 'ASC')
        ->with('services:id,title')
        ->with('account:id,name')
        ->with('company:id,name,account_id')
        ->get()->toArray();


        $sales = array_merge($sales1, $sales2);

        $overall_price1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
        ->where('periodical_one_off', '=', 1)
        ->sum('overall_price');

        $overall_price2 = Sales::where('until_date', '>', $next_momnth)
        ->where('until_date', '<', $next_year)
        ->where('periodical_one_off', '=', 1)
        ->sum('overall_price');

        $overall_price = $overall_price1 + $overall_price2;
        // $overall_price = Sales::sum('overall_price');
     
        $head_title = 'All ($'.$overall_price.')';
        return view('user.invoicings.projected_revenues', [
            'sales' => $sales,
            'head_title' => $head_title,
            'sales_filters_dates_arrary' => $sales_filters_dates_arrary,
            'months' => $this->months
        ]);
    }

    public function sales_year_filter (Request $req){

        if(!$req->year){
            return response()->json(['code' => 400, 'msg' => 'error']);
        }
        $sales = [];
        $head_title = '';
        if($req->year != 'all'){
            $sales_this_month = Sales::where('until_date', 'LIKE',$req->year.'%')->where('periodical_one_off', '=', 1)->orderBy('until_date', 'DESC')->with('services:id,title')->with('account:id,name')->with('company:id,name,account_id')->get()->toArray();
            $month  = substr($req->year,5,7);
            $year = substr($req->year,0,4);
            $year_d = date($year);
            $month_prev = date($month-1);
            $last_day_prev = date('t', strtotime("$year_d-$month_prev-01"));

            $month_prev = $month_prev < 10 ? '0'.$month_prev : $month_prev;
            $select_year = $year;
            if($month_prev == '0'){
                $month_prev = '12';
                $select_year =  (intval( $year) - 1);
            }
            $sales_this_month_prev = Sales::where('until_date', 'LIKE',$select_year.'-'.$month_prev.'-'.$last_day_prev.'%')->where('periodical_one_off', '=', 1)->orderBy('until_date', 'DESC')->with('services:id,title')->with('account:id,name')->with('company:id,name,account_id')->get()->toArray();
            $overall_price = 0;
            foreach($sales_this_month as $key => $sales_this){
                if($sales_this['until_date'] != $req->year.'-'.date('t', strtotime("$req->year-01")).' 00:00:00'){
                    $overall_price +=  $sales_this['overall_price'];
                    $sales[]= $sales_this;
                }
            }

            foreach($sales_this_month_prev as $sale_this_month_prev){
                $sales[] = $sale_this_month_prev;
                $overall_price +=  $sale_this_month_prev['overall_price'];
            }

            $month  = $this->months[$month];
            $head_title = 'Projected Revenues for '. $month.' '.$year.': $'.$overall_price ;
        }else{
            $next_momnth = (new \DateTime('first day of next month'))->format('Y-m-d');
            $next_year = date('Y-m-d', strtotime("+12 months $next_momnth"));
            $sales2 = Sales::where('until_date', '>', $next_momnth)
            ->where('until_date', '<', $next_year)
            ->where('periodical_one_off', '=', 1)
            ->orderBy('until_date', 'DESC')
            ->with('services:id,title')
            ->with('account:id,name')
            ->with('company:id,name,account_id')
            ->get()->toArray();

            $date = new \DateTime('now');
            $date->modify('last day of this month');
            $last_day_this_month = $date->format('Y-m-d');
    
            $sales1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
            ->where('periodical_one_off', '=', 1)
            ->orderBy('until_date', 'ASC')
            ->with('services:id,title')
            ->with('account:id,name')
            ->with('company:id,name,account_id')
            ->get()->toArray();

            $sales = array_merge($sales1, $sales2);
            $overall_price = Sales::where('until_date', '>', $next_momnth)
            ->where('until_date', '<', $next_year)
            ->where('periodical_one_off', '=', 1)
            ->sum('overall_price');
  
            $overall_price1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
            ->where('periodical_one_off', '=', 1)
            ->sum('overall_price');

            $overall_price = $overall_price + $overall_price1;

            $head_title = 'All ($'.$overall_price.')';
        }

        return response()->json(['code' => 200, 'msg' => $sales, 'title' => $head_title]);
    }

    public function Dtinvoicings (Request $req){




        if(!$req->year){
            return response()->json(['code' => 400, 'msg' => 'error']);
        }
        $sales = [];
        $head_title = '';
        if($req->year != 'all'){
            $sales_this_month = Sales::where('until_date', 'LIKE',$req->year.'%')
            ->where('periodical_one_off', '=', 1)
            ->orderBy('until_date', 'DESC')
            ->with('services:id,title')
            ->with('account:id,name')
            ->with('company:id,name,account_id')
            ->get()->toArray();
            // dd($sales_this_month);
            $month  = substr($req->year,5,7);
            $year = substr($req->year,0,4);
            $year_d = date($year);
            $month_prev = date($month-1);
            $last_day_prev = date('t', strtotime("$year_d-$month_prev-01"));

            $month_prev = $month_prev < 10 ? '0'.$month_prev : $month_prev;
            $select_year = $year;
            if($month_prev == '0'){
                $month_prev = '12';
                $select_year =  (intval( $year) - 1);
            }
            $sales_this_month_prev = Sales::where('until_date', 'LIKE',$select_year.'-'.$month_prev.'-'.$last_day_prev.'%')->where('periodical_one_off', '=', 1)->orderBy('until_date', 'DESC')->with('services:id,title')->with('account:id,name')->with('company:id,name,account_id')->get()->toArray();
            $overall_price = 0;
            foreach($sales_this_month as $key => $sales_this){
                if($sales_this['until_date'] != $req->year.'-'.date('t', strtotime("$req->year-01")).' 00:00:00'){
                    $overall_price +=  $sales_this['overall_price'];
                    $sales[]= $sales_this;
                }
            }

            foreach($sales_this_month_prev as $sale_this_month_prev){
                $sales[] = $sale_this_month_prev;
                $overall_price +=  $sale_this_month_prev['overall_price'];
            }

            $month  = $this->months[$month];
            $head_title = 'Projected Revenues for '. $month.' '.$year.': $'.$overall_price ;
        }else{
            $next_momnth = (new \DateTime('first day of next month'))->format('Y-m-d');
            $next_year = date('Y-m-d', strtotime("+12 months $next_momnth"));
            $sales2 = Sales::where('until_date', '>', $next_momnth)
            ->where('until_date', '<', $next_year)
            ->where('periodical_one_off', '=', 1)
            ->orderBy('until_date', 'DESC')
            ->with('services:id,title')
            ->with('account:id,name')
            ->with('company:id,name,account_id')
            ->get()->toArray();

            $date = new \DateTime('now');
            $date->modify('last day of this month');
            $last_day_this_month = $date->format('Y-m-d');
    
            $sales1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
            ->where('periodical_one_off', '=', 1)
            ->orderBy('until_date', 'ASC')
            ->with('services:id,title')
            ->with('account:id,name')
            ->with('company:id,name,account_id')
            ->get()->toArray();

            $sales = array_merge($sales1, $sales2);
            $overall_price = Sales::where('until_date', '>', $next_momnth)
            ->where('until_date', '<', $next_year)
            ->where('periodical_one_off', '=', 1)
            ->sum('overall_price');
  
            $overall_price1 = Sales::where('until_date', 'LIKE',$last_day_this_month.'%')
            ->where('periodical_one_off', '=', 1)
            ->sum('overall_price');

            $overall_price = $overall_price + $overall_price1;

            $head_title = 'All ($'.$overall_price.')';
        }
        if ($req->ajax()) {

            $data = $sales;
            return Datatables::of($data)
            // ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('open_newtax_returns', function($row){
                    return '';
                })
                ->addColumn('company_name', function($row){
                    if(!empty($row['company'])){
                        return $row['company']['name'];
                    }
                    return ''; 
                })
                ->addColumn('account_name', function($row){
                    if(!empty($row['account'])){
                        return $row['account']['name'];
                    }
                    return ''; 
                })

                ->addColumn('service_name', function($row){
                    if(!empty($row['services'])){
                        return $row['services']['title'];
                    }
                    return '';
                })
               
                ->addColumn('additional_value', function($row) use ($head_title) {
                    return $head_title ?? $row;
                })

                ->rawColumns(['action', 'additional_value'])
                ->make(true);  
        }

    }
}
