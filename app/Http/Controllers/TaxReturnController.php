<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\TaxReturnPdf;
use App\Models\TaxReturns;
use App\Models\TaxReturnAccounts;
use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use Auth;
use PDF;

class TaxReturnController extends Controller
{
    public $taxYears = [];
    //
        // public function create_tax_returns(Request $req){
    //     $tax_returns = new TaxReturns();

    //     if( !empty($req->input('tax_end'))){
    //         $tax_returns->user_id = Auth::user()->id; 
    //         $tax_returns->company_id = $req->input('company_id');
    //         $tax_returns->tax_end = $req->input('tax_end');
           
    //         if($tax_returns->save()){
    //             return response()->json(['code' => 200, 'msg' => $tax_returns->id]);
    //         }
    //         return response()->json(['code' => 400, 'msg' => 'error']);
    //     }
    //     return response()->json(['code' => 400, 'msg' => 'error']);
    // }

    public   $tax_company_status = [
        '1' => 'Active & Trading',
        '2' => 'Non Trading (Traded Before)',
        '3' => 'Dormant (Never Traded)',
        // '4' => 'Disregarded Entity',
    ];
    public function create_tax_returns(Request $req){
        $url = url()->previous();
        $tax_returns = new TaxReturns();

        $file = $req->file('file');

        // dd($req->all());

        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $tax_returns['file_path'] = asset('storage/public/Files/'.$filename);
        }elseif($req->input('file_link')){
            $tax_returns->file_path = $req->input('file_link');
        }

        $tax_returns->user_id = Auth::user()->id; 
        $tax_returns->company_id = $req->input('company_id');
        $tax_returns->tax_end = $req->input('tax_end');
        $tax_returns->tax_start = $req->input('start_date');
        $tax_returns->due_date = $req->input('due_date');
        $tax_returns->status = $req->input('status');

        if(!empty($req->input('due_date'))){
            $tax_returns->status = $req->input('status');
        }else{
            $tax_returns->status = 3;
        }

        $tax_returns->company_status = $req->input('company_status');
        $tax_returns->tax_return_type = $req->input('tax_return_type');
        $tax_returns->file_date_1 = $req->input('file_date_1');
        $tax_returns->file_date_2 = $req->input('file_date_2');
        $tax_returns->google_drive = $req->input('google_drive');
        
        if($req->input('LLC_Tax_Status_for_This_Tax_Year_exist') == 1){
            $tax_returns->LLC_Tax_Status_for_This_Tax_Year = $req->input('LLC_Tax_Status_for_This_Tax_Year');
        }
        
        if($tax_returns->save()){

            $generate_file_link = $req->file('filing_extension');

            $TaxReturnPdf = new TaxReturnPdf();

            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/public/PDF'), $filename);
                $TaxReturnPdf['path'] = asset('torage/public/PDF/'.$filename);
            }elseif($req->input('generate_file')){
                $TaxReturnPdf->path = $req->input('generate_file');
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/company/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/company'))) {
                    mkdir(public_path('uploads/company'));
                }
                fopen(public_path('uploads/company/'.$fileName), 'w');
                file_put_contents(public_path('uploads/company/'.$fileName), $data);
                $google_drive = new GoogleDriveController;
                $google_link =  $google_drive->add_file(['file'=> asset('uploads/company/'.$fileName), 'name'=>$fileName]);
                // dd($google_link);
                
                $file_real_path = asset('uploads/company/'.$fileName);
                if(!empty($google_link['link'])){
                  $file_real_path = $google_link['link'];
                }
                $TaxReturnPdf->path = $file_real_path ; //asset('uploads/company/'.$fileName);

            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }

            $TaxReturnPdf->user_id = Auth::user()->id; 
            $TaxReturnPdf->company_id = $req->input('company_id');
            $TaxReturnPdf->tax_return_id = $tax_returns->id;
            $TaxReturnPdf->year = substr($req->input('tax_end'),0,4);
            $TaxReturnPdf->save();

            return redirect()->to($url)->with('success',  'Tax Returns Creades');
        } 
        return redirect()->to($url)->with('danger',  'Tax Returns is not created');
    }

    public function delete_tax_returns ($id){
        $url = url()->previous();
        $data = TaxReturns::find($id);
        if(empty($data)){
            return redirect()->to($url)->with('danger',  'Tax Returns is not deleted');
        }
        if( $data->delete()){
            return redirect()->to($url)->with('success',  'Tax Returns is deleted');
        }
    }

    public function tax_returns_by_url($url, $id){
        $user_id = Auth::user()->id;

        $company = Company::find($id);

        $status_dateTime = $company->status_date;
        $status_dateYear = date('Y', strtotime($status_dateTime));
        $all_tax_years = TaxReturns::where('company_id', $id)->get(['tax_end'])->toArray();
        $this->get_tax_years($company, $status_dateYear, $all_tax_years);


        $tax_status = ['1' => 'Not Filed', '2' => 'Filed', '3' =>'NA'];
        
        $tax_return_type = [
            "1" =>'1120 (Corporation)',
            "2" =>'1120 (Foreign Disregarded Entity)',
            "3" =>'1065 (Partnership)',
            "4" =>'No Return Due'
        ];

        $all_tax_year_prev = [];
        if($company->company_id == 3){
            $all_tax_year_prev = TaxReturns::where($url."_id", $id)->get(['tax_end', 'LLC_Tax_Status_for_This_Tax_Year'])->toArray();
        }

        return view('user.tax_returns.tax_returns', [
            'tax_returns' => TaxReturns::where($url."_id", $id)->with('company')->with('pdfFile')->get(),
            'url' => $url,
            'id' => $id,
            'tax_years' => $this->taxYears,
            'company' => $company,
            'tax_status' => $tax_status,
            'tax_company_status' => $this->tax_company_status,
            'tax_return_type' => $tax_return_type,
            'page_title' => $company->name,
            'all_tax_year_prev' => $all_tax_year_prev
        ]);
    }

    public function edit_tax_returns(Request $req){
        
        $tax_id = $req->input('tax_id');
        $tax_returns = TaxReturns::find($tax_id);
        $tax_returns->user_id = Auth::user()->id;
        $file = $req->file('file');

        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $tax_returns['file_path'] = asset('storage/public/Files/'.$filename);
        }elseif($req->input('file_link')){
            $tax_returns->file_path = $req->input('file_link');
        }

        $tax_returns->due_date = $req->input('due_date');
        $tax_returns->status = $req->input('status');
        if(!empty($req->input('due_date'))){
            $tax_returns->status = $req->input('status');
        }else{
            $tax_returns->status = 3;
        }
        $tax_returns->company_status = $req->input('company_status');
        $tax_returns->tax_return_type = $req->input('tax_return_type');
        $tax_returns->LLC_Tax_Status_for_This_Tax_Year = $req->input('LLC_Tax_Status_for_This_Tax_Year');
        $tax_returns->file_date_1 = $req->input('file_date_1');
        $tax_returns->file_date_2 = $req->input('file_date_2');
        $tax_returns->google_drive = $req->input('google_drive');

        $generate_file_link = $req->file('filing_extension');
       
        $TaxReturnPdf = TaxReturnPdf::where('tax_return_id', '=', $tax_id)->get()->first();

        if(empty($TaxReturnPdf )){
            $TaxReturnPdf = new TaxReturnPdf();

            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/'), $filename);
                $TaxReturnPdf['path'] = asset('storage/'.$filename);
            }elseif($req->input('generate_file')){
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/company/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/company'))) {
                    mkdir(public_path('uploads/company'));
                }
                fopen(public_path('uploads/company/'.$fileName), 'w');
                file_put_contents(public_path('uploads/company/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/company/'.$fileName);
            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }
            $TaxReturnPdf->user_id = Auth::user()->id; 
            $TaxReturnPdf->company_id = $tax_returns->company_id;
            $TaxReturnPdf->tax_return_id = $tax_id;
            $TaxReturnPdf->year =substr($tax_returns->tax_end,0,4);
           
        }else{
            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/'), $filename);
                $TaxReturnPdf['path'] = asset('storage/'.$filename);
            }elseif($req->input('generate_file')){
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/company/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/company'))) {
                    mkdir(public_path('uploads/company'));
                }
                fopen(public_path('uploads/company/'.$fileName), 'w');
                file_put_contents(public_path('uploads/company/'.$fileName), $data);
                $google_drive = new GoogleDriveController;
                $google_link =  $google_drive->add_file(['file'=> asset('uploads/company/'.$fileName), 'name'=>$fileName]);
                // dd($google_link);
                
                $file_real_path = asset('uploads/company/'.$fileName);
                if(!empty($google_link['link'])){
                  $file_real_path = $google_link['link'];
                }
                $TaxReturnPdf->path = $file_real_path ; //asset('uploads/company/'.$fileName);
            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }
        }

        $TaxReturnPdf->save();
        
        $url = url()->previous();
        if($tax_returns->save()){
            return redirect()->to($url)->with('success',  'Tax Returns Edited');
        } 
        return redirect()->to($url)->with('danger',  'Tax Returns is not Edited');

    }

    public function get_tax_years($company, $year, $all_tax_years)
    {
        $month = $company->month;
        $day = $company->day;
        if(!$month || !$day || !$company->status_date){
            return $this->taxYears = "wrong";
        }
        $month = $month < 10 ? "0$month" : $month;
        $day = $day < 10 ? "0$day" : $day;
        $taxDate = strtotime("$year-$month-$day");
        $flag = 1;

        foreach ($all_tax_years as $all_tax_year){
            if("$year-$month-$day" == $all_tax_year['tax_end']){
                $flag = 0;
            }
        }

        if($taxDate < time() && $taxDate > strtotime($company->status_date) && $flag) {
            $this->taxYears[] = date('Y-m-d', $taxDate);
            $year = $year + 1;
            return $this->get_tax_years($company, $year, $all_tax_years);
        }elseif(($year + 1) < date('Y')) {
            $year = $year + 1;
            return $this->get_tax_years($company, $year, $all_tax_years);
        }
        return;
    }

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
 
}
