<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TaxReturnPdfAccounts;
use App\Models\TaxReturnAccounts;
use App\Models\Company;
use App\Models\Account;
use App\Models\User;
use App\Models\Country;
use Auth;
use PDF;

class TaxReturnAccountController extends Controller
{
    public $taxYears = [];

    public function create_tax_returns_account(Request $req){
        $url = url()->previous();
        $tax_returns = new TaxReturnAccounts();

        $file = $req->file('file');

        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $tax_returns['file_path'] = asset('storage/public/Files/'.$filename);
        }elseif($req->input('file_link')){
            $tax_returns->file_path = $req->input('file_link');
        }

        $tax_returns->user_id = Auth::user()->id; 
        $tax_returns->account_id = $req->input('account_id');
        $tax_returns->tax_end = $req->input('tax_end');
        $tax_returns->tax_start = $req->input('start_date');
        $tax_returns->due_date = $req->input('due_date');
        $tax_returns->status = $req->input('status');
        $tax_returns->company_status = $req->input('company_status');
        $tax_returns->tax_return_type = $req->input('tax_return_type');
        $tax_returns->google_drive = $req->input('google_drive');

        if($req->input('company_status') == 2 || $req->input('company_status') == 3){
            $tax_returns->spouseed = 1;
            $tax_returns->fullname = $req->input('fullname'); 
            $tax_returns->SSN_or_ITIN = $req->input('SSN_or_ITIN'); 
            $tax_returns->bday = $req->input('bday'); 
            $tax_returns->country_id = $req->input('country_id'); 
            $tax_returns->disabled = $req->input('desabled_field');
        }

    //  dd($tax_returns->disabled);
        
        if($tax_returns->save()){

            $generate_file_link = $req->file('filing_extension');

            $TaxReturnPdf = new TaxReturnPdfAccounts();

            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/public/PDF'), $filename);
                $TaxReturnPdf['path'] = asset('storage/public/PDF/'.$filename);
            }elseif($req->input('generate_file')){
                $TaxReturnPdf->path = $req->input('generate_file');
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('account_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/account/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('account_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/account'))) {
                    mkdir(public_path('uploads/account'));
                }
                fopen(public_path('uploads/account/'.$fileName), 'w');
                file_put_contents(public_path('uploads/account/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/account/'.$fileName);

            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }

            $TaxReturnPdf->user_id = Auth::user()->id; 
            $TaxReturnPdf->account_id = $req->input('account_id');
            $TaxReturnPdf->tax_return_id = $tax_returns->id;
            $TaxReturnPdf->year = substr($req->input('tax_end'),0,4);
            $TaxReturnPdf->save();

            return redirect()->to($url)->with('success',  'Tax Returns Creades');
        } 
        return redirect()->to($url)->with('danger',  'Tax Returns is not created');
    }

    public function delete_tax_returns ($id){
        $url = url()->previous();
        $data = TaxReturnAccounts::find($id);
        if(empty($data)){
            return redirect()->to($url)->with('danger',  'Tax Returns is not deleted');
        }
        if( $data->delete()){
            return redirect()->to($url)->with('success',  'Tax Returns is deleted');
        }
       
    }

    public function tax_returns_by_url_account($url, $id){
        $user_id = Auth::user()->id;

        $account = Account::find($id);

        // $incorporationTime = $company->incorporation_date;
        // $incorporationYear = date('Y', strtotime($incorporationTime));
        $all_tax_years = TaxReturnAccounts::where('account_id', $id)->get(['tax_end'])->toArray();

        $tax_status = ['1' => 'Not Filed', '2' => 'Filed'];
        $tax_account_status = [
            '1' => 'Dormant (never traded)',
            '2' => 'Non trading (but traded before)',
            '3' => 'Trading',
            '4' => 'Disregarded Entity',
        ];
        $tax_return_type = [
            '1' => '1120 (Corporation)',
            '2' => '1120 (Foreign Disregarded Entity)',
            '3' => '1065 (Partnership)',
        ];

        return view('user.tax_returns.tax_returns_account', [
            'tax_returns' => TaxReturnAccounts::where('user_id', $user_id)->where($url."_id", $id)->with('account')->with('pdfFile')->get(),
            'url' => $url,
            'id' => $id,
            'countries' => Country::all(),
            'account' => $account,
            'tax_status' => $tax_status,
            'tax_company_status' => $tax_account_status,
            'tax_return_type' => $tax_return_type,
            'page_title' => $account->name
        ]);
    }

    public function edit_tax_returns_account(Request $req){
        $tax_id = $req->input('tax_id');
        $tax_returns = TaxReturnAccounts::find($tax_id);
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
        $tax_returns->company_status = $req->input('company_status');
        $tax_returns->tax_return_type = $req->input('tax_return_type');
        $tax_returns->google_drive = $req->input('google_drive');
        
        $generate_file_link = $req->file('filing_extension');
       
        $TaxReturnPdf = TaxReturnPdfAccounts::where('tax_return_id', '=', $tax_id)->get()->first();

        if(empty($TaxReturnPdf )){
            $TaxReturnPdf = new TaxReturnPdfAccounts();

            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/'), $filename);
                $TaxReturnPdf['path'] = asset('storage/'.$filename);
            }elseif($req->input('generate_file')){
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('account_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/account/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('account_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/account'))) {
                    mkdir(public_path('uploads/account'));
                }
                fopen(public_path('uploads/account/'.$fileName), 'w');
                file_put_contents(public_path('uploads/account/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/account/'.$fileName);
            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }
            $TaxReturnPdf->user_id = Auth::user()->id; 
            $TaxReturnPdf->account_id = $tax_returns->account_id;
            $TaxReturnPdf->tax_return_id = $tax_id;
            $TaxReturnPdf->year =substr($tax_returns->tax_end,0,4);
           
        }else{
            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/'), $filename);
                $TaxReturnPdf['path'] = asset('storage/'.$filename);
            }elseif($req->input('generate_file')){
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('account_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/account/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('account_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/account'))) {
                    mkdir(public_path('uploads/account'));
                }
                fopen(public_path('uploads/account/'.$fileName), 'w');
                file_put_contents(public_path('uploads/account/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/account/'.$fileName);
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

    public function get_prev_year_tax_return_account(Request $req){

        $tax_end = substr($req->tax_end,0,4);
        $tax_end= (int) $tax_end - 1;
        $prev_year =  TaxReturnAccounts::where('account_id',$req->account_id)->where('spouseed', 1)->where('tax_end', 'LIKE', '%'.$tax_end.'%')->first();

        if(!empty($prev_year)){
            return response()->json(['code' => 200, 'msg' => $prev_year ?? '']);
        }
        return response()->json(['code' => 400, 'msg' => []]);

       

    }
}
