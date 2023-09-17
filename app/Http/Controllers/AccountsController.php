<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\CorporateAppointment;
use App\Models\TaxReturnAccounts;
use App\Models\TypeOfCompaneis;
use App\Mail\AccountEmailSender;
use App\Models\AccountSendEmail;
use App\Models\AppointmentsRole;
use App\Models\AddressRelation;
use App\Models\AddressProvider;
use App\Models\IndustriesType;
use App\Models\FileReations;
use App\Models\CompanyType;
use App\Models\CompanyFile;
use App\Models\Services;
use App\Models\Address;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Notes;
use App\Models\Files;
use App\Models\Sales;
use App\Models\User;
use DataTables;
use Auth;

class AccountsController extends Controller
{

    public $months =  array(
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July ',
        'August',
        'September',
        'October',
        'November',
        'December',
    );

    public function index(){
        // $id = Auth::user()->id;
        $accounts = Account::orderBy('name', 'asc')->with('salesPerodical')->get();
        return view('user.account.accounts', [
            'countries' => Country::all(),
            'account_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'accounts' => $accounts,// where('user_id', $id)->get(),
            'all_accounts' => $accounts->pluck( 'id', 'name' ),
            'users'=>User::all(['id', 'first_name', 'last_name']),
            ]);
    }

    public function add_account(Request $req){

        $data = new Account();
        
        $data->name = $req->input('name');
        $data->user_id = Auth::user()->id;
        $data->owner_id = $req->input('owner_id');
        $data->account_personality_type = $req->input('account_personality_type');
        $data->account_type_id = $req->input('account_type_id');
        $data->parent_id = $req->input('parent_id') ? $req->input('parent_id') : 0 ;
        $data->email = $req->input('email');
        $data->industry_id = $req->input('industry_id');
        $data->account_phone = $req->input('account_phone');
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
        // $data->email_1 = $req->input('email_1');
        $data->email_2 = $req->input('email_2');
        $data->email_3 = $req->input('email_3');
        $data->email_4 = $req->input('email_4');
        // $data->phone_1 = $req->input('phone_1');
        // $data->phone_2 = $req->input('phone_2');
        $data->phone_3 = $req->input('phone_3');
        $data->phone_4 = $req->input('phone_4');

        
        if(empty($req->input('account_personality_type'))){
            $data->registration_status = $req->input('registration_status');
            $data->tax_id_type = $req->input('tax_id_type');
            $data->tax_id = $req->input('tax_id');
            $data->status_date = $req->input('status_date');
            $data->tax_filing_code = $req->input('tax_filing_code');
            $data->google_drive = $req->input('google_drive');
            $data->bday = $req->input('bday');
            $data->country_id = $req->input('country_id');
            $data->disabled_field = $req->input('desabled_field');
        }
        // dd($data);
       
        if($data->save()){
            if(empty($req->input('account_personality_type'))){
                $fale_paths = ['file_path_1','file_path_2','file_path_3','file_path_4'];
                $doc_types_array = [
                    'file_path_1' => 'doc_type_1',
                    'file_path_2' => 'doc_type_2',
                    'file_path_3' => 'doc_type_3',
                    'file_path_4' => 'doc_type_4',
                ];
                $finalArray = array();
                foreach($fale_paths as $fale_path){
                    if( !empty($req->input($fale_path))){
                        $doc_type = $doc_types_array[$fale_path] ?? "";
                        $doc_type = $req->input($doc_type) ?? "";
                        array_push($finalArray, array(
                            'user_id' => Auth::user()->id, 
                            'account_id' => $data->id,
                            'company_id' => null,
                            'file_type' => $fale_path,
                            'doc_type' => $doc_type,
                            'path' => $req->input($fale_path),
                            'created_at' =>date('Y-m-d H:i:s', time()),
                            'updated_at' =>date('Y-m-d H:i:s', time()),
                        ));
                    }
                }
                CompanyFile::insert($finalArray);
            }
            return redirect()->route('accounts')->with('success', $req->input('name').' - Added');
        }
    }

    public function edit_account(Request $req, $id){
        $account = Account::whereId($id)->withCount('contacts')->with('country')->first();

        if(empty($account)){
            return redirect()->route('accounts')->with('danger', "Not Found");
        }

        if ($_POST){
                $account->name = $req->input('name');
                $account->user_id = Auth::user()->id;
                $account->account_personality_type = $req->input('account_personality_type');
                $account->owner_id = $req->input('owner_id');
                $account->account_type_id = $req->input('account_type_id');
                $account->parent_id = $req->input('parent_id') ? $req->input('parent_id') : 0;
                $account->email = $req->input('email');
                $account->industry_id = $req->input('industry_id');
                $account->account_phone = $req->input('account_phone');
                $account->website = $req->input('website');
                $account->additional_phone = $req->input('additional_phone');
                $account->employees = $req->input('employees');
                $account->description = $req->input('description');
                $account->address_1_street = $req->input('address_1_street');
                $account->address_1_country = $req->input('address_1_country');
                $account->address_1_city = $req->input('address_1_city');
                $account->address_1_state = $req->input('address_1_state');
                $account->address_1_zip_code = $req->input('address_1_zip_code');
                $account->address_2_street = $req->input('address_2_street');
                $account->address_2_country = $req->input('address_2_country');
                $account->address_2_city = $req->input('address_2_city');
                $account->address_2_state = $req->input('address_2_state');
                $account->address_2_zip_code = $req->input('address_2_zip_code');
                // $account->email_1 = $req->input('email_1');
                $account->email_2 = $req->input('email_2');
                $account->email_3 = $req->input('email_3');
                $account->email_4 = $req->input('email_4');
                // $account->phone_1 = $req->input('phone_1');
                // $account->phone_2 = $req->input('phone_2');
                $account->phone_3 = $req->input('phone_3');
                $account->phone_4 = $req->input('phone_4');

                if(empty($req->input('account_personality_type'))){
                    $account->registration_status = $req->input('registration_status');
                    $account->tax_id_type = $req->input('tax_id_type');
                    $account->tax_id = $req->input('tax_id');
                    $account->status_date = $req->input('status_date');
                    $account->tax_filing_code = $req->input('tax_filing_code');
                    $account->google_drive = $req->input('google_drive');
                    $account->bday = $req->input('bday');
                    $account->country_id = $req->input('country_id');
                    $account->disabled_field = $req->input('desabled_field');
                }

                if ($account->save()) {
                    if(empty($req->input('account_personality_type'))){
                    
                        $fale_paths = ['file_path_1','file_path_2','file_path_3','file_path_4'];
                        $doc_types_array = [
                            'file_path_1' => 'doc_type_1',
                            'file_path_2' => 'doc_type_2',
                            'file_path_3' => 'doc_type_3',
                            'file_path_4' => 'doc_type_4',
                        ];
                        foreach($fale_paths as $fale_path){
                            $CompanyFile = CompanyFile::where('account_id', '=', $account->id)->where('file_type', '=', $fale_path)->get()->first();
                            $doc_type = $doc_types_array[$fale_path] ?? "";
                            $doc_type = $req->input($doc_type) ?? "";
                            if(empty($CompanyFile) && !empty($req->input($fale_path))){
                                $CompanyFile = new CompanyFile;
                                $CompanyFile->user_id = Auth::user()->id; 
                                $CompanyFile->account_id = $account->id;
                                $CompanyFile->file_type = $fale_path;
                                $CompanyFile->path = $req->input($fale_path);
                                $CompanyFile->doc_type = $doc_type;
                                $CompanyFile->save();
                            }elseif($CompanyFile){
                                $file_link_text = '';
                                if($req->input($fale_path)){
                                    $file_link_text = $req->input($fale_path);
                                }
                                $CompanyFile->path = $file_link_text;
                                $CompanyFile->doc_type = $doc_type;
                                $CompanyFile->save();
                            }
                        }
                    }
                    return redirect()->route('edit_account', [$id])->with('success', $req->input('name') . ' - Edited');
                }
        }

        $notifications = new NotificationController;
        return view('user.account.edit_account', [
            'company_types_account' => CompanyType::all(),
            'company_types' => TypeOfCompaneis::all(),
            'industries_types' => IndustriesType::all(),
            'account' => $account,
            'accounts' => Account::all( 'id', 'name' ),// Account::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'users' => User::all(['id', 'first_name', 'last_name', 'email']),
            'companies' => Company::all( 'id', 'name' ),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::all( 'id', 'title','first_name', 'last_name' ),//where('user_id', '=', Auth::user()->id)->get(['id', 'title','first_name', 'last_name']),
            'countries' => Country::all(),
            'companies_count' =>Company::where('account_id', '=', $id)->get(['id', 'name']), //Company::where('user_id', '=', Auth::user()->id)->where('account_id', '=', $id)->get(['id', 'name']),
            'contacts_count' => Contact::/*where('user_id', '=', Auth::user()->id)->*/where('account_id', '=', $id)->get(['id', 'title','first_name', 'last_name']),
            'emails' => AccountSendEmail::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'notifications' => $notifications->notifications('related_to',$id),
            'upcoming_overdues' => $notifications->UpcomingOverdue('related_to',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'url' => 'account',
            'id' => $id,
            'page_title' => $account->name,
            'notes' => Notes::where('account_id', '=', $id)->get(),
            'files' => FileReations::where('account_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::/*where('user_id', '=', Auth::user()->id)->*/with('file')->get(),
            'addresses' => Address:: //where('user_id', '=', Auth::user()->id)
            with('country')
            ->with('state')
            ->with('addressRelation')
            ->whereHas('addressRelation', function($q) use($id){$q->where('account_id', $id);})->get(),
            'all_addresses' => Address::/*where('user_id', '=', Auth::user()->id)->*/with('country')->with('state')->with('county')->with('addressRelation')->get(),
            'address_relations' => AddressRelation::/*where('user_id', '=', Auth::user()->id)->*/where('account_id', '=', $id)->with('addresses')->get(),

            'corporate_appointments' => CorporateAppointment::/*where('user_id', '=', Auth::user()->id)->*/where('account_id', '=', $id)->with('roles')->get(),
            'appointments_roles' => AppointmentsRole::all(),
            'address_providers' => AddressProvider::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'months' => $this->months,
            'services' => Services::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'sales' => Sales::/*where('user_id', '=', Auth::user()->id)->*/where('account_id', '=', $id)->where('Expired_Entrie', '=', null)->orderBy('created_at', 'DESC')->with('services')->get(),
            'Expired_Entrie_sales' => Sales::where('account_id', '=', $id)->where('Expired_Entrie', '!=', null)->orderBy('created_at', 'DESC')->with('services')->get(),
            'tax_returns' => TaxReturnAccounts::where('account_id', $id)->with('pdfFile')->get(),
            
        ]);
    }

    public function delete_account($id){
        $account = Account::find($id);
        if(empty($account)){
            return redirect()->route('accounts')->with('danger', "Not Found");
        }
        if($account->delete()){
            return redirect()->route('accounts')->with('success', $account->name.' - Removed');
        }
    }

    public function get_parent_account_ajax (Request $req){
        if($req->ajax()){
            $account = Account::query()->where('name', 'like', '%'. $req->parent_account .'%')->get();
            return  $account;
        }
    }

    public function Dtaccounts(Request $request) {
        if ($request->ajax()) {
            $data = Account::orderBy('name', 'asc')->with('salesPerodical')->get();
            $head_title = 'All Accounts ('. $data->count().')';
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    
                    return '';
                })
                ->addColumn('accountTypes', function($row){
                    $accountTypes = $row->accountTypes && $row->accountTypes->name?$row->accountTypes->name : "";
                    return $accountTypes;
                })
                ->addColumn('Google_Drive', function($row){
                    return $row->google_drive;
                })
                ->addColumn('additional_value', function($row) use ($head_title) {
                    return $head_title ?? '';
                })
                ->rawColumns(['action','accountTypes','Google_Drive','additional_value'])
                ->make(true);
        }
    }
}
