<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxReturns;
use App\Models\TaxReturnAccounts;
use App\Models\Country;
use DataTables;

class TaxReturnsViewController extends Controller
{
    //
    public   $tax_company_status = [
        '1' => 'Active & Trading',
        '2' => 'Non Trading (Traded Before)',
        '3' => 'Dormant (Never Traded)',
    ];

    public function tax_returns(){
        // $TaxReturnAccounts = TaxReturnAccounts::with('account:id,name')->with('pdfFile')->get()->toArray();
        // $TaxReturns =  TaxReturns::with(['company:id,name,company_id'])->with('pdfFile')->get()->toArray();
        $TaxReturnAccounts = TaxReturnAccounts::
        select(['tax_return_accounts.*', 'accounts.name as account_name'])
        ->with('account:id,name')
        ->with('pdfFile')
        ->join('accounts', 'tax_return_accounts.account_id', '=', 'accounts.id')
        ->orderBy('accounts.name', 'ASC')->get()->toArray();

        $TaxReturns = TaxReturns::
        select(['tax_returns.*', 'companies.name as company_name'])
        ->with('companyWithAccount:id,name,company_id,account_id')
        ->with('pdfFile')
        ->join('companies', 'tax_returns.company_id', '=', 'companies.id')
        ->where('companies.status', '=', 1)
        ->orderBy('companies.name', 'ASC')->get()->toArray();

        $tax_return_array = [];
        $tax_return_array_years = [];
        if(!empty($TaxReturns)){
            foreach($TaxReturns as $TaxReturn){
                $TaxReturn['notification'] = 'company';
                $TaxReturn['page_tite'] = strtolower($TaxReturn['company_with_account']['name']);
                $data = "";
                if(substr($TaxReturn['tax_end'],0,4) != 0){
                    $data = substr($TaxReturn['tax_end'],0,4);
                    if(!isset($tax_return_array[$data])){
                        $tax_return_array[$data][] = $TaxReturn;
                    }
                    else{
                        $tax_return_array[$data] = array_merge($tax_return_array[$data], [$TaxReturn]);
                    }
                }
            }
        }

        if(!empty($TaxReturnAccounts)){
            foreach($TaxReturnAccounts as $TaxReturnAccount){
                $TaxReturnAccount['notification'] = 'account';
                $TaxReturnAccount['page_tite'] = strtolower($TaxReturnAccount['account']['name']);
                $data = "";
                if(substr($TaxReturnAccount['tax_end'],0,4) != 0){
                    $data = substr($TaxReturnAccount['tax_end'],0,4);
                    if(!isset($tax_return_array[$data])){
                        $tax_return_array[$data][] = $TaxReturnAccount;
                    }
                    else{
                        $tax_return_array[$data] = array_merge($tax_return_array[$data], [$TaxReturnAccount]);
                    }
                }
            }
        }

        $tax_return_array_years = array_keys($tax_return_array);
        rsort($tax_return_array_years);


        foreach($tax_return_array as $key => $tax_return_value){
            if($key != $tax_return_array_years[0]){
                unset($tax_return_array[$key]);
            }else{
                $tax_return_array = $tax_return_array[$key];
            }
        }

        // $tax_return_array = $this->array_msort($tax_return_array, array('page_tite'=>SORT_ASC));

        $keys = array_column($tax_return_array, 'page_tite');
        array_multisort($keys, SORT_ASC, $tax_return_array);
    
        $head_title = 'All Tax Returns ('.count($tax_return_array).')';
        return view('user.tax_returns.index', [
            'countries' => Country::all(),
            'head_title' => $head_title,
            'tax_returns' => $tax_return_array,
            'tax_return_array_years' => $tax_return_array_years,
            'tax_company_status' => $this->tax_company_status,
            ]);
    }

    public  function array_msort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }

    public function year_filter_tax_returns(Request $req){

        if(!$req->year){
            return response()->json(['code' => 400, 'msg' => 'error']);
        }

        // $TaxReturnAccounts = TaxReturnAccounts::where('tax_end', 'LIKE', '%'.$req->year.'%')
        // ->with('account:id,name')->with('pdfFile')->get()->toArray();


        // $TaxReturns = TaxReturns::where('tax_end', 'LIKE', '%'.$req->year.'%')
        // ->with('companyWithAccount:id,name,company_id,account_id')
        // ->with('pdfFile')
        // ->get()->toArray();


        $TaxReturnAccounts = TaxReturnAccounts::select(['tax_return_accounts.*', 'accounts.name as account_name'])
        ->where('tax_end', 'LIKE', '%'.$req->year.'%')
        ->with('account:id,name')
        ->with('pdfFile')
        ->join('accounts', 'tax_return_accounts.account_id', '=', 'accounts.id')
        ->orderBy('accounts.name', 'ASC')->get()->toArray();
        
        $TaxReturns = TaxReturns::where('tax_end', 'LIKE', '%'.$req->year.'%')->
        select(['tax_returns.*', 'companies.name as company_name'])
        ->where('tax_end', 'LIKE', '%'.$req->year.'%')
        ->with('companyWithAccount:id,name,company_id,account_id')
        ->with('pdfFile')
        ->join('companies', 'tax_returns.company_id', '=', 'companies.id')
        ->where('companies.status', '=', 1)
        ->orderBy('companies.name', 'ASC')->get()->toArray();


        $tax_return_array = [];
        if(!empty($TaxReturns)){
            foreach($TaxReturns as $TaxReturn){
                $TaxReturn['page_tite'] = strtolower($TaxReturn['company_with_account']['name']);
                $tax_return_array[]=$TaxReturn;
            }
            //$tax_return_array = array_merge($tax_return_array, $TaxReturns);
        }

        if(!empty($TaxReturnAccounts)){
            $tx = [];
            foreach($TaxReturnAccounts as $TaxReturnAccount){
                $TaxReturnAccount['page_tite'] = strtolower($TaxReturnAccount['account']['name']);
                $tax_return_array[]=$TaxReturnAccount;
            }
            
            //$tax_return_array = array_merge($tax_return_array, $TaxReturnAccounts);
        }

        // dd($tax_return_array);
        $keys = array_column($tax_return_array, 'page_tite');
        array_multisort($keys, SORT_ASC, $tax_return_array);

        $head_title = 'All Tax Returns ('.count($tax_return_array).')';

        return response()->json(['code' => 200, 'msg' => $tax_return_array, 'title' => $head_title]);
    }

    public function sort_by_name_tax_returns(Request $req){

        if(!$req->sort){
            return response()->json(['code' => 400, 'msg' => 'error']);
        }
        $sortDirection = $req->sort;

        // $TaxReturnAccounts = TaxReturnAccounts::where('tax_end', 'LIKE', '%'.$req->year.'%')
        // ->with('account:id,name')
        // ->with('pdfFile')
        // ->orderBy(Account::select('name')
        //     ->whereColumn('accounts.id', 'tax_return_accounts.account_id'), $sortDirection)
        // ->get()
        // // ->sortBy('account.name') //mi tarberak
        // ->toArray();

        // faster method
        $TaxReturnAccounts = TaxReturnAccounts::
        select(['tax_return_accounts.*', 'accounts.name as account_name'])
        ->with('account:id,name')
        ->with('pdfFile')
        ->where('tax_end', 'LIKE', '%'.$req->year.'%')
        ->join('accounts', 'tax_return_accounts.account_id', '=', 'accounts.id')
        ->orderBy('accounts.name', $sortDirection)->get()->toArray();
  

        // $TaxReturns =  TaxReturns::where('tax_end', 'LIKE', '%'.$req->year.'%')->with(['company' => function ($query) use ($sortDirection) {
        //     $query->select('id','name','company_id')->orderBy('name', $sortDirection);
        // }])->with('pdfFile')->get()->toArray();

        $tax_return_array = [];

        // $TaxReturns = TaxReturns::where('tax_end', 'LIKE', '%'.$req->year.'%')
        // ->with(['company:id,name,company_id'])
        // ->with('pdfFile')
        // ->orderBy(Company::select('name')
        //     ->whereColumn('companies.id', 'tax_returns.company_id'), $sortDirection)
        // ->get()->toArray();
        
        // faster method
        $TaxReturns = TaxReturns::
        select(['tax_returns.*', 'companies.name as company_name'])
        ->with('companyWithAccount:id,name,company_id,account_id')
        ->with('pdfFile')
        ->where('tax_end', 'LIKE', '%'.$req->year.'%')
        ->join('companies', 'tax_returns.company_id', '=', 'companies.id')
        ->orderBy('companies.name', $sortDirection)->get()->toArray();

        if(!empty($TaxReturns)){
            $tax_return_array = array_merge($tax_return_array, $TaxReturns);
        }
        if(!empty($TaxReturnAccounts)){
            $tax_return_array = array_merge($tax_return_array, $TaxReturnAccounts);
        }
        $head_title = 'All Tax Returns ('.count($tax_return_array).')';

        return response()->json(['code' => 200, 'msg' => $tax_return_array, 'title' => $head_title]);
    }

    public function get_prev_year(Request $req){

        $tax_end = substr($req->tax_end,0,4);
        $tax_end= (int) $tax_end - 1;
        $prev_year =  TaxReturns::where('company_id',$req->page_id)->where('tax_end', 'LIKE', '%'.$tax_end.'%')->first();

        return response()->json(['code' => 200, 'msg' => $prev_year ?? '']);
    }

    public function DttaxReturnd(Request $req){


        if(!$req->year){
            return response()->json(['code' => 400, 'msg' => 'error']);
        }

        $TaxReturnAccounts = TaxReturnAccounts::select(['tax_return_accounts.*', 'accounts.name as account_name'])
        ->where('tax_end', 'LIKE', '%'.$req->year.'%')
        ->with('account:id,name')
        ->with('pdfFile')
        ->join('accounts', 'tax_return_accounts.account_id', '=', 'accounts.id')
        ->orderBy('accounts.name', 'ASC')->get()->toArray();
        
        $TaxReturns = TaxReturns::where('tax_end', 'LIKE', '%'.$req->year.'%')->
        select(['tax_returns.*', 'companies.name as company_name'])
        ->where('tax_end', 'LIKE', '%'.$req->year.'%')
        ->with('companyWithAccount:id,name,company_id,account_id')
        ->with('pdfFile')
        ->join('companies', 'tax_returns.company_id', '=', 'companies.id')
        ->where('companies.status', '=', 1)
        ->orderBy('companies.name', 'ASC')->get()->toArray();


        $tax_return_array = [];
        if(!empty($TaxReturns)){
            foreach($TaxReturns as $TaxReturn){
                $TaxReturn['page_tite'] = strtolower($TaxReturn['company_with_account']['name']);
                $TaxReturn['page_type'] = 'company';
                $tax_return_array[]=$TaxReturn;
            }
        }

        if(!empty($TaxReturnAccounts)){
            $tx = [];
            foreach($TaxReturnAccounts as $TaxReturnAccount){
                $TaxReturnAccount['page_tite'] = strtolower($TaxReturnAccount['account']['name']);
                $TaxReturnAccount['page_type'] = 'account';
                $tax_return_array[]=$TaxReturnAccount;
            }

        }

        // $keys = array_column($tax_return_array, 'page_tite');
        // array_multisort($keys, SORT_ASC, $tax_return_array);

        $head_title = 'All Tax Returns ('.count($tax_return_array).')';



        // dd($tax_return_array);


        if ($req->ajax()) {
            $data = $tax_return_array;
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('TaxPayer', function($row){
                    return $row['page_type']??'';
                })
                ->addColumn('page_tite', function($row){
                    return $row['page_tite']??'';
                })

                ->addColumn('company_name', function($row){
                    if(!empty($row['company'])){
                        return $row['company']['name'];
                    }
                    return ''; 
                })

                ->addColumn('account_name', function($row){
                    if(!empty($row['company_with_account']) && !empty($row['company_with_account']['parent_account'])){
                        return $row['company_with_account']['parent_account']['name'];
                    }
                    return ''; 
                })
               
                ->addColumn('additional_value', function($row) use ($head_title) {
                    return $head_title ?? '';
                })

                ->rawColumns(['action', 'additional_value'])
                ->make(true);
        }
    }

}
