<?php
// composer require yajra/laravel-datatables-oracle:"~9.0"
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorporateAppointment;
use App\Models\EmailNotifications;
use App\Models\AppointmentsRole;
use App\Models\AccountSendEmail;
use App\Models\AddressProvider;
use App\Models\AddressRelation;
use App\Models\TypeOfCompaneis;
use App\Models\FollowingCompany;
use App\Models\TaskTemplate;
use App\Models\FileReations;
use App\Models\CompanyType;
use App\Models\CompanyFile;
use App\Models\TaxReturns;
use App\Models\Address;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\TaskSet;
use App\Models\Files;
use App\Models\Notes;
use App\Models\User;
use App\Models\Services;
use App\Models\Sales;
use DataTables;
use Auth;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyCreated;

use App\Jobs\UpdateCompanyJob;

use App\Events\ChangeCompanyStatus;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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


    public $taxYears = [];

   public $disengagement_reasons = [
        1 => 'Unresponsive',
        2 => 'Non Payment',
        3 => 'Unhappy with the Services',
        4 => 'Closing Business',
        5 => 'Other (see comments)',
     ];

    public function index($by = null)
    {
    
        $companies = [];
        $company_isset_divisoins = [];
        $company_isset_divisoins = Company::select('division')
        // ->where('type', '=', 'Client')
        // ->where('status', '=', '1')
        ->where('division', '!=', 'null')
        ->groupBy('division')
        ->get()
        ->toArray() ;
        // $company_isset_divisoins = Company::select('division')->distinct()->get(); //big version
        // $company_isset_divisoins = DB::table('companies')->select('id','name', 'email')->groupBy('division')->get(); DB version
        // $id = Auth::user()->id;

        if(!$by){
            $company_isset_divisoins = Company::select('division')
            ->where('type', '=', 'Client')
            ->where('status', '=', '1')
            ->where('division', '!=', 'null')
            ->groupBy('division')
            ->get()
            ->toArray();
        }

        if(!empty($company_isset_divisoins[0]['division'])){
            $companies = Company::where('type', '=', 'Client')
            ->where('status', '=', '1')
            ->where('division', '=', $company_isset_divisoins[0]['division'])
            ->with('parentAccount:id,name')
            ->with('salesPerodical')->orderBy('name', 'ASC')->get();
        }else{
            $companies = Company::where('type', '=', 'Client')->where('status', '=', '1')->with('salesPerodical') ->with('parentAccount:id,name')->orderBy('name', 'ASC')->get();
        }

        $head_title = 'All Active Client Companies ('.$companies->count().')';
        if($by == 'disengaged'){
            $company_isset_divisoins = Company::select('division')
            ->where('status', '!=', '1')
            ->where('division', '!=', 'null')
            ->groupBy('division')
            ->get()
            ->toArray();
            
            if(!empty($company_isset_divisoins[0]['division'])){
                $companies = Company::where('status', '!=', '1')->where('division', '=', $company_isset_divisoins[0]['division']) ->with('parentAccount:id,name')->with('salesPerodical')->orderBy('name', 'ASC')->get();
            }else{
                $companies = Company::where('status', '!=', '1') ->with('parentAccount:id,name')->with('salesPerodical')->orderBy('name', 'ASC')->get();
            }
            
            $head_title = 'All Disengaged Companies ('.$companies->count().')';
        }

        if($by == 'readymades'){

            $company_isset_divisoins = Company::select('division')
            ->where('type', '=', 'Readymade')
            ->where('division', '!=', 'null')
            ->groupBy('division')
            ->get()
            ->toArray();

            if(!empty($company_isset_divisoins[0]['division'])){
                $companies = Company::where('type', '=', 'Readymade')->where('division', '=', $company_isset_divisoins[0]['division']) ->with('parentAccount:id,name')->with('salesPerodical')->orderBy('name', 'ASC')->get();
            }else{
                $companies = Company::where('type', '=', 'Readymade') ->with('parentAccount:id,name')->with('salesPerodical')->orderBy('name', 'ASC')->get();
            }
            $head_title = 'All Readymade Companies ('.$companies->count().')';
        }

        if($by == 'group'){
            $company_isset_divisoins = Company::select('division')
            ->where('type', '=', 'Group')
            ->where('division', '!=', 'null')
            ->groupBy('division')
            ->get()
            ->toArray();

            if(!empty($company_isset_divisoins[0]['division'])){
                $companies = Company::where('type', '=', 'Group')->where('division', '=', $company_isset_divisoins[0]['division']) ->with('parentAccount:id,name')->orderBy('name', 'ASC')->get();
            }else{
                $companies = Company::where('type', '=', 'Group') ->with('parentAccount:id,name')->orderBy('name', 'ASC')->get();
            }
            
            $head_title = 'All Group Companies ('.$companies->count().')';
        }

        if($by == 'awaiting-Tax-ID'){
            $company_isset_divisoins = Company::select('division')
            ->where('registration_status', '=', '3')
            ->where('division', '!=', 'null')
            ->groupBy('division')
            ->get()
            ->toArray();

            if(!empty($company_isset_divisoins[0]['division'])){
                $companies = Company::where('registration_status', '=', '3')
                ->where('division', '=', $company_isset_divisoins[0]['division'])
                ->with('companyFiles1')
                ->with('parentAccount:id,name')
                ->orderBy('name', 'ASC')
                ->get();
            }else{
                $companies = Company::where('registration_status', '=', '3')
                ->with('companyFiles')
                ->with('parentAccount:id,name')
                ->orderBy('name', 'ASC')
                ->get();
            }
            
            $head_title = 'All Companies Waiting for Tax ID ('.$companies->count().')';
        }

        if($by == 'recently-issued-Tax-ID'){
            $prev_42 = date("Y-m-d", strtotime(date('Y-m-d', time()) ." -42 days"));

            $company_isset_divisoins = Company::select('division')
            ->where('status_date', '>=', $prev_42)
            ->where('status_date', '<=', date('y-m-d'))
            ->where('division', '!=', 'null')
            ->with('country:id,name,code')
            ->with('state:id,name,abbreviation')
            ->with('parentAccount:id,name')
            ->with('companyTypes:id,name,abbreviation')
            ->with('companyFiles1')
            ->with('salesPerodical')
            ->groupBy('division')
            ->get()
            ->toArray();

            $companies =  [];
            if(!empty($company_isset_divisoins[0]['division'])){
                $companies = Company::where('status_date', '>=', $prev_42)
                ->where('status_date', '<=', date('y-m-d'))
                ->where('division', '=', $company_isset_divisoins[0]['division'])
                ->with('companyFiles1')
                ->with('parentAccount:id,name')
                ->orderBy('name', 'ASC')
                ->get();
            }
            
            if(!empty($companies)){
                $head_title = 'All last 42 reg day Tax ID ('.$companies->count().')';
            }else{
                $head_title = 'All last 42 reg day Tax ID (0)';
            }
            
        }

        if($by == 'all'){
            $companies = Company::orderBy('name', 'ASC') ->with('parentAccount:id,name')->get();
            $head_title = 'All Companies ('.$companies->count().')';
        }

        if($by == 'missing-tax-returns'){
            $thisYear = @date('Y-m-d');
            $lastYear = date('Y',strtotime('- 1 year', strtotime($thisYear)));
            $last_year_tax_returns = TaxReturns::where('tax_end', 'LIKE', $lastYear.'%')->pluck('company_id')->toArray();

            $company_isset_divisoins = Company::
            selectRaw('Distinct companies.division,status_date')
            ->whereNotIn('companies.id', $last_year_tax_returns)
            ->where('tax_id', '!=', 'null')
            ->where('status', '=', '1')
            ->where('status_date', '!=', 'null')
            ->where('status_date', '<=', $lastYear.'-12-02 00:00:00')
            ->where('division', '!=', 'null')
            // ->groupBy('division')
            ->get()
            ->unique('division')
            ->toArray();

            //query filter example
            // $company_isset_divisoins = $company_isset_divisoins->filter(function($value, $key) {
            //     $thisYear = @date('Y-m-d');
            //     $lastYear = date('Y',strtotime('- 1 year', strtotime($thisYear)));
            //         return strtotime($value['status_date']) < strtotime($lastYear.'-12-02');
            //     });


            if(!empty($company_isset_divisoins[0]['division'])){
                $companies = Company::selectRaw('Distinct companies.*')
                ->where('division', '=', $company_isset_divisoins[0]['division'])
                ->where('status_date', '<', $lastYear.'-12-02 00:00:00')
                ->where('status_date', '!=', 'null')
                ->where('tax_id', '!=', 'null')
                ->where('status', '=', '1')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->whereNotIn('companies.id', $last_year_tax_returns)  
                ->orderBy('name', 'ASC')->get(); 
            }else{
                $companies = Company::selectRaw('Distinct companies.*')
                ->where('tax_id', '!=', 'null')
                ->where('status', '=', '1')
                ->where('status_date', '<', $lastYear.'-12-02 00:00:00')
                ->where('status_date', '!=', 'null')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->whereNotIn('companies.id', $last_year_tax_returns)  
                ->orderBy('name', 'ASC')->get();
            }

            $head_title = 'All Companies with Missing Tax Return  ('.$companies->count().')';
        }

        $all_tax_year_prev = [];
        // if($companies->company_id == 3){
        //     $all_tax_year_prev = TaxReturns::where('company_id', $id)->get(['tax_end', 'LLC_Tax_Status_for_This_Tax_Year'])->toArray();
        // }

        return view('user.company.index', [
            'company_types' => TypeOfCompaneis::all(),
            'companies' => $companies,
            // 'companies_DESC' => Company::orderBy('name', 'DESC')->get(), //all(),//where('user_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::all('id', 'name'),//where('user_id', '=', $id)->get(['id', 'name']),
            'contacts' => Contact::all('id', 'title', 'first_name', 'last_name'),//where('user_id', '=', $id)->get(['id', 'title']),
            'users' => User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name']),
            'months' => $this->months,
            'company_isset_divisoins' => $company_isset_divisoins,
            'head_title' => $head_title,
            'sort_by' => $by,
            'all_tax_year_prev' =>$all_tax_year_prev,
            'page_by' => $by,
        ]);
    }

    public function get_sorting_companies(Request $req){
        if($req->ajax()){
            $companies = Company::with('country')->with('state')->with('parentAccount')->with('companyTypes')->orderBy('name', 'DESC')->get();
            if(!empty($companies)){
                return response()->json(['code' => 200, 'msg' => $companies]);
            }
            return response()->json(['code' => 403, 'msg' => 'error']);
        }
        return redirect()->route('companies')->with('danger', "Not Found"); 
    }

    public function companies_by_account($id)
    {
        $user_id = Auth::user()->id;
        return view('user.company.index', [
            'company_types' => TypeOfCompaneis::all(),
            'companies' => Company::where('account_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::all('id', 'name'),//where('user_id', '=', $user_id)->get(['id', 'name']),
            'contacts' => Contact::all('id', 'title', 'first_name', 'last_name'),//where('user_id', '=', $user_id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name']),
            'tax_years' => $this->taxYears,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $company = new Company();
        $company->user_id = Auth::user()->id;
        $company->type = $request->input('type');
        $company->name = $request->input('name');
        $company->status = $request->input('status');
        $company->filing = $request->input('filing');
        $company->state_id = $request->input('state_id');
        $company->division = $request->input('division');
        $company->company_id = $request->input('company_id');
        $company->country_id = $request->input('country_id');
        $company->sub_status = $request->input('sub_status');
        $company->account_id = $request->input('account_id');
        $company->contact_id = $request->input('contact_id');
        $company->filing_status = $request->input('filing_status');
        $company->previous_name1 = $request->input('previous_name1');
        $company->previous_name2 = $request->input('previous_name2');
        $company->previous_name3 = $request->input('previous_name3');
        $company->previous_name4 = $request->input('previous_name4');
        $company->previous_name5 = $request->input('previous_name5');
        $company->incorporation_date = $request->input('incorporation_date');
        $company->registration_status = $request->input('registration_status');
        $company->tax_id_type = $request->input('tax_id_type');
        $company->tax_id = $request->input('tax_id');
        $company->tax_filing_code = $request->input('tax_filing_code');
        $company->status_date = $request->input('status_date');
        $company->month = $request->input('month');
        $company->day = $request->input('day');
        $company->company_activity = $request->input('company_activity');
        $company->address1 = $request->input('address1');
        $company->address2 = $request->input('address2');
        $company->city = $request->input('city');
        $company->zip = $request->input('zip');
        $company->correspondence_state = $request->input('correspondence_state');
        $company->engagement_start_date = $request->input('engagement_start_date');
        $company->engagement_end_date = $request->input('engagement_end_date');
        $company->google_drive = $request->input('google_drive');

        if($company->save()){

            $add_company = EmailNotifications::find(1)->toArray();
            if($add_company['status'] == 1){
                $emails = explode(",", $add_company['to']);
                $email_data = [];
                $user_name = Auth::user()->last_name. ' '. Auth::user()->first_name ;
               
                $url = url('/company').'/'.$company->id;
                  // $url = '<a href="'.$url.'">Company</a>'; 
                $url = new HtmlString('<a href="' . $url . '">Company</a>');
           
                $healthy = array('[company]', '[user]', '[link]');
                $yummy   = array($company->name, $user_name,  $url, );
                $email_data['body'] =  str_replace($healthy, $yummy, $add_company['body']);
                $email_data['subject'] = $add_company['subject'];
    
                foreach($emails as $email){
                    if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                        Mail::to(trim($email))
                        ->bcc('poterop744@larland.com')
                        ->send(new CompanyCreated($email_data));
                    }
                }
            }

            // foreach($fale_paths as $fale_path){
            //     if( !empty($request->input($fale_path))){
            //         $CompanyFile = new CompanyFile;
            //         $CompanyFile->user_id = Auth::user()->id; 
            //         $CompanyFile->company_id = $company->id;
            //         $CompanyFile->file_type = $fale_path;
            //         $CompanyFile->path = $request->input($fale_path);
            //         $CompanyFile->save();
            //     }
            // }
            $fale_paths = ['file_path_1','file_path_2','file_path_3','file_path_4'];
            $doc_types_array = [
                'file_path_1' => 'doc_type_1',
                'file_path_2' => 'doc_type_2',
                'file_path_3' => 'doc_type_3',
                'file_path_4' => 'doc_type_4',
            ];
            $finalArray = array();
            foreach($fale_paths as $fale_path){
                if( !empty($request->input($fale_path))){
                    $doc_type = $doc_types_array[$fale_path] ?? "";
                    $doc_type = $request->input($doc_type) ?? "";
                    array_push($finalArray, array(
                        'user_id' => Auth::user()->id, 
                        'company_id' => $company->id,
                        'file_type' => $fale_path,
                        'doc_type' => $doc_type,
                        'path' => $request->input($fale_path),
                        'created_at' =>date('Y-m-d H:i:s', time()),
                        'updated_at' =>date('Y-m-d H:i:s', time()),
                    ));
                }
            }

            CompanyFile::insert($finalArray);
    
            // $files_type = ['file_1', 'file_2', 'file_3', 'file_4'];
            // foreach($files_type as $file_type){
            //     if(session($file_type)){
            //         $CompanyFile = CompanyFile::find(session($file_type));
            //         $CompanyFile->company_id = $company->id;
            //         $CompanyFile->save();
            //         session()->put($file_type,  0);
            //     }
            // }
            return redirect()->route('companies')->with('success', $request->input('name').' - Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        if(empty($company)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
        
        $status_dateTime = $company->status_date;
        $status_dateYear = date('Y', strtotime($status_dateTime));
        $all_tax_years = TaxReturns::where('company_id', $id)->get(['tax_end'])->toArray();
        $this->get_tax_years($company, $status_dateYear, $all_tax_years);

        $all_tax_year_prev = [];
        if($company->company_id == 3){
            $all_tax_year_prev = TaxReturns::where('company_id', $id)->get(['tax_end', 'LLC_Tax_Status_for_This_Tax_Year'])->toArray();
        }
       
        $notifications = new NotificationController;
        return view('user.company.edit', [
            'company' => $company,
            'company_types' => TypeOfCompaneis::all(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'individual_accounts'=> Account::/*where('user_id', '=', Auth::user()->id)->*/where('account_personality_type', '=', 0)->get(['id', 'name']),
            'contacts' => Contact::all('id', 'title','first_name', 'last_name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'title','first_name', 'last_name']),
            'users' => User::all(['id', 'first_name', 'last_name', 'email']),
            'companies' =>Company::/*where('user_id', '=', Auth::user()->id)->*/get(['id', 'name']),
            'companies_count' => Company::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts_count' => Contact::all('id', 'title','first_name', 'last_name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'title','first_name', 'last_name']),
            'emails' => AccountSendEmail::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'notifications'=> $notifications->notifications('company_id',$id),
            'upcoming_overdues' => $notifications->UpcomingOverdue('company_id',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'url' => 'company',
            'id' => $id,
            'page_title' => $company->name,
            'notes' => Notes::where('company_id', '=', $id)->get(),
            'files' => FileReations::where('company_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::/*where('user_id', '=', Auth::user()->id)->*/with('file')->get(),
            'corporate_appointments' => CorporateAppointment::/*where('user_id', '=', Auth::user()->id)->*/where('company_id', '=', $id)->with('roles')->with('company')->with('contact')->with('account')->get(),
            'appointments_roles' => AppointmentsRole::all(),
            'address_providers' => AddressProvider::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'addresses' => Address::/*where('user_id', '=', Auth::user()->id)->*/with('country')->with('state')->with('addressRelation')->whereHas('addressRelation', function($q) use($id){$q->where('company_id', $id);})->get(),
            'address_relations' => AddressRelation::/*where('user_id', '=', Auth::user()->id)->*/where('company_id', '=', $id)->with('addresses')->get(),
            'all_addresses' => Address::/*where('user_id', '=', Auth::user()->id)->*/with('country')->with('state')->with('county')->with('addressRelation')->get(),
            'months' => $this->months,
            'tax_returns' => TaxReturns::where('company_id', $id)->orderBy('tax_end', 'DESC')->with('pdfFile')->get(),
            'all_tax_year_prev' => $all_tax_year_prev,
            'following_companies' => FollowingCompany::where('company_id', $id)->with('contact:id,first_name,last_name')->get()->toArray(),
            'tax_years' => $this->taxYears,
            'services' => Services::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'sales' => Sales::/*where('user_id', '=', Auth::user()->id)->*/where('company_id', '=', $id)->where('Expired_Entrie', '=', null)->orderBy('created_at', 'DESC')->with('services')->get(),
            'Expired_Entrie_sales' => Sales::where('company_id', '=', $id)->where('Expired_Entrie', '!=', null)->orderBy('created_at', 'DESC')->with('services')->get(),
            'disengagement_reasons' => $this->disengagement_reasons,
            'task_templates' =>  TaskTemplate::with('user:id,first_name,last_name')->get()->toArray(),
            'task_sets' => TaskSet::with('user:id,first_name,last_name')->with('taskRelation')->get()->toArray(),
            'company_task_sets' => TaskSet::where('company_id', $id)->with('user:id,first_name,last_name')->with('taskRelation')->get()->toArray(),
        ]);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $company = Company::find($id);

        if(empty($company)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
            $company_status = $company->status;
            $company->name = $request->input('name');
            $company->filing = $request->input('filing');
            $company->state_id = $request->input('state_id');
            $company->company_id = $request->input('company_id');
            $company->country_id = $request->input('country_id');
            $company->filing_status = $request->input('filing_status');
            $company->account_id = $request->input('account_id');
            $company->contact_id = $request->input('contact_id');
            $company->type = $request->input('type');
            $company->division = $request->input('division');
            $company->status = $request->input('status');
            $company->sub_status = $request->input('sub_status');
            $company->previous_name1 = $request->input('previous_name1');
            $company->previous_name2 = $request->input('previous_name2');
            $company->previous_name3 = $request->input('previous_name3');
            $company->previous_name4 = $request->input('previous_name4');
            $company->previous_name5 = $request->input('previous_name5');
            $company->incorporation_date = $request->input('incorporation_date');
            $company->registration_status = $request->input('registration_status');
            $company->tax_id_type = $request->input('tax_id_type');
            $company->tax_id = $request->input('tax_id');
            $company->tax_filing_code = $request->input('tax_filing_code');
            $company->status_date = $request->input('status_date');
            $company->month = $request->input('month');
            $company->day = $request->input('day');
            $company->company_activity = $request->input('company_activity');
            $company->address1 = $request->input('address1');
            $company->address2 = $request->input('address2');
            $company->city = $request->input('city');
            $company->zip = $request->input('zip');
            $company->correspondence_state = $request->input('correspondence_state');
            $company->engagement_start_date = $request->input('engagement_start_date');
            $company->engagement_end_date = $request->input('engagement_end_date');
            $company->google_drive = $request->input('google_drive');

            if($request->input('status') == 0 && !empty($request->input('disengagement_reason'))){
               $company->disengagement_reason = $request->input('disengagement_reason'); 
            }

            $fale_paths = ['file_path_1','file_path_2','file_path_3','file_path_4'];
            $doc_types_array = [
                'file_path_1' => 'doc_type_1',
                'file_path_2' => 'doc_type_2',
                'file_path_3' => 'doc_type_3',
                'file_path_4' => 'doc_type_4',
            ];

            foreach($fale_paths as $fale_path){
                $CompanyFile = CompanyFile::where('company_id', '=', $id)->where('file_type', '=', $fale_path)->get()->first();
                $doc_type = $doc_types_array[$fale_path] ?? "";
                $doc_type = $request->input($doc_type) ?? "";
                if(empty($CompanyFile) && !empty($request->input($fale_path))){
                    $CompanyFile = new CompanyFile;
                    $CompanyFile->user_id = Auth::user()->id; 
                    $CompanyFile->company_id = $id;
                    $CompanyFile->file_type = $fale_path;
                    $CompanyFile->path = $request->input($fale_path);
                    $CompanyFile->doc_type = $doc_type;
                    $CompanyFile->save();
                }elseif($CompanyFile){
                    $file_link_text = '';
                    if($request->input($fale_path)){
                        $file_link_text = $request->input($fale_path);
                    }
                    $CompanyFile->path = $file_link_text;
                    $CompanyFile->doc_type = $doc_type;
                    $CompanyFile->save();
                }
            }

            if($company->save()){

                $add_company = EmailNotifications::find(2)->toArray();
                if($company_status != $request->input('status')){
                    $status = '';
                    if($request->input('status') == 1){
                        $status = 'Active';
                    }elseif($request->input('status') == 0){
                        $status = 'Disengaged';
                    }

                    $emails = explode(",", $add_company['to']);
                    $email_data = [];
                    $user_name = Auth::user()->last_name. ' '. Auth::user()->first_name ;
                    $url = url('/company').'/'.$company->id;
                    $url = new HtmlString('<a href="' . $url . '">Company</a>');
                    $healthy = array('[company]', '[user]', '[link]', '[status]', '[comment]', '[reason_for_disengagement]');
                    $yummy   = array($company->name, $user_name,  $url, $status,'', '');
                    $email_data['body'] =  str_replace($healthy, $yummy, $add_company['body'],);
                    $email_data['subject'] = $add_company['subject'];
        
                    foreach($emails as $email){
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            Mail::to(trim($email))
                            ->bcc('poterop744@larland.com')
                            ->send(new CompanyCreated($email_data));
                        }
                    }
                }

                return redirect()->route('edit_company', [$id])->with('success', $request->input('name') . ' - Edited');
            }
        return redirect()->route('companies')->with('danger', $request->input('name').' - is not your');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $data = Company::find($id);
        if(empty($data)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
        if($data->delete()){
            return redirect()->route('companies')->with('success', $data->name.' - Removed');
        }
    }

    public function uploade_file_company(Request $req){

        // $CompanyFile = new CompanyFile;
        $files = new Files;
        $file = $req->file('file');
        $filename = '';
        if($file){
            $files->name = $file->getClientOriginalName();
            $files->size = $file->getSize();
            $files->type = $file->getMimeType();
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $files['path'] = $filename;

            // $CompanyFile->user_id = Auth::user()->id; 
            // $CompanyFile->file_type = $req->input('file_type');
            // $CompanyFile->path = asset('storage/public/Files/'.$filename);


        }else{
            return "NO FILE";
        }

        // $CompanyFile->save();
        $files->save();

        // session()->put($req->input('file_type'),  $files->id);
        return response()->json(['code' => 200, 'msg' => asset('storage/public/Files/'.$filename)]);
    }

    public function update_file_company(Request $req){

        $files = CompanyFile::where('company_id', '=', $req->company_id)->where('file_type', '=', $req->file_type)->get()->first();
      
        if(empty( $files->id)){
            $files = new CompanyFile;
        }

        $file = $req->file('file');
        $filename = '';
        if($file){
            $files->company_id = $req->company_id;
            $files->name = $file->getClientOriginalName();
            $files->size = $file->getSize();
            $files->type = $file->getMimeType();
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $files['path'] = $filename;
            $files->user_id = Auth::user()->id; 
            $files->file_type = $req->file_type;
        
        }else{
            return "NO FILE";
        }

        $files->save();
        return response()->json(['code' => 200, 'msg' => $filename]);
    }

    public function filter_companies_by_division(Request $req){

        if(!$req->division){
            return response()->json(['code' => 400, 'msg' => 'error']);
        }
        $get_array = [   
            'name',
            'id',
            'country_id',
            'state_id',
            'incorporation_date',
            'status_date',
            'tax_id',
            'type',
            'company_id',
            'account_id',
            'google_drive',
            'division'
        ];

        // $companies = Company::where('status', '!=', '1')->orderBy('name', 'ASC')->get();
        // $companies = Company::where('type', '=', 'Readymade')->orderBy('name', 'ASC')->get();
        // $companies = Company::where('type', '=', 'Group')->orderBy('name', 'ASC')->get();

        $companies = Company::where('division', '=', $req->division)
                ->where('type', '=', 'Client')
                ->where('status', '=', '1')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get($get_array);

        // $company_isset_divisoins = Company::select('division')
        // ->where('division', '!=', 'null')
        // ->groupBy('division')
        // ->get()
        // ->toArray();

        if($req->sort_by == 'disengaged'){
            $companies = Company::where('division', '=', $req->division)
                ->with('country:id,name,code')
                ->where('status', '!=', '1')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get($get_array);
        }

        if($req->sort_by == 'readymades'){
            $companies = Company::where('division', '=', $req->division)
                ->with('country:id,name,code')
                ->where('type', '=', 'Readymade')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get($get_array)
                ->toArray();
        }

        if($req->sort_by == 'group'){
            $companies = Company::where('division', '=', $req->division)
                ->with('country:id,name,code')
                ->where('type', '=', 'Group')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get($get_array)
                ->toArray();
        }

        if($req->sort_by == 'awaiting-Tax-ID'){
            $companies = Company::where('division', '=', $req->division)
                ->where('registration_status', '=', '3')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('companyFiles1')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get($get_array)
                ->toArray();
        }

        if($req->sort_by == 'recently-issued-Tax-ID'){
            $prev_42 = date("Y-m-d", strtotime(date('Y-m-d', time()) ." -42 days"));
            $companies = Company::where('division', '=', $req->division)
                ->where('status_date', '>=', $prev_42)
                ->where('status_date', '<=', date('y-m-d'))
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('companyFiles1')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get($get_array)
                ->toArray();
        }

        if($req->sort_by == 'missing-tax-returns'){
            $thisYear = @date('Y-m-d');
            $lastYear = date('Y',strtotime('- 1 year', strtotime($thisYear)));
            $last_year_tax_returns = TaxReturns::where('tax_end', 'LIKE', $lastYear.'%')->pluck('company_id')->toArray();

            $companies = Company::selectRaw('Distinct companies.*')
            ->where('tax_id', '!=', 'null')
            ->where('status', '=', '1')
            ->where('status_date', '<', $lastYear.'-12-02 00:00:00')
            ->where('status_date', '!=', 'null')
            ->with('country:id,name,code')
            ->with('state:id,name,abbreviation')
            ->with('parentAccount:id,name')
            ->with('companyTypes:id,name,abbreviation')
            ->with('salesPerodical')
            ->where('companies.division','=', $req->division)
            ->whereNotIn('companies.id', $last_year_tax_returns)  
            ->orderBy('name', 'ASC')->get()->toArray();
        }
        

    return response()->json(['code' => 200, 'msg' => $companies /*, 'divisions'=>$company_isset_divisoins*/]);

    }

    public function prepare_tax_return_modal(Request $req){
        $company = Company::where('id', $req->company_id)->first();

        $status_dateTime = $company->status_date;
        $status_dateYear = date('Y', strtotime($status_dateTime));
        $all_tax_years = TaxReturns::where('company_id', $company->id)->get(['tax_end'])->toArray();
        $this->get_tax_years($company, $status_dateYear, $all_tax_years);
        

        $all_tax_year_prev = [];
        if($company->company_id == 3){
            $all_tax_year_prev = TaxReturns::where('company_id', $company->id)->get(['tax_end', 'LLC_Tax_Status_for_This_Tax_Year'])->toArray();
        }
    
        return response()->json(['code' => 200, 'msg'=>$company, 'tax_years'=> $this->taxYears, 'all_tax_year_prev'=>$all_tax_year_prev] );
    }

    public function disengage_company(Request $req){
  
        $url_previous = url()->previous();
        $note_id = null;
        if($req->id){
            $id = $req->id;
            $company = Company::find($id);

            if(empty($company)){
                return redirect()->to($url_previous)->with('danger',  'Company is not found');
            }

            if(!empty($req->input('comment'))){
                $note = new Notes();

                if(!empty($company->note_id)){
                    $note =  Notes::find($company->note_id);
                }
    
                $disengagement_reasons = $this->disengagement_reasons;
                $disengagement_reason = '';
    
                if(!empty($disengagement_reasons[$req->input('disengagement_reason')])){
                    $disengagement_reason = $disengagement_reasons[$req->input('disengagement_reason')];
                }
    
                $note->title = "Disengagement: ".$disengagement_reason;
                $note->company_id = $id;
                $note->user_id = Auth::user()->id;
                $note->content = $req->input('comment');
    
                if($note->save()){
                    $note_id = $note->id;
                }
            }
          
            $company->note_id = $note_id;
            $company->disengagement_reason = $req->input('disengagement_reason');
            $company->disengagement_comment = $req->input('comment');
            $company->status = 0;
            $company->engagement_end_date = $req->input('disengagement_date');

            if($company->save()){
                $add_company = EmailNotifications::find(2)->toArray();
                $status = 'Disengaged';
                $emails = explode(",", $add_company['to']);
                $email_data = [];
                $user_name = Auth::user()->last_name. ' '. Auth::user()->first_name ;
                $url = url('/company').'/'.$company->id;               
                $url = new HtmlString('<a href="' . $url . '">Company</a>');
               
                $healthy = array('[company]', '[user]', '[link]', '[status]', '[comment]', '[reason_for_disengagement]');
                $yummy   = array($company->name, $user_name,  $url, $status, $req->input('comment'), $this->disengagement_reasons[$req->input('disengagement_reason')]);
                $email_data['body'] =  str_replace($healthy, $yummy, $add_company['body'],);
                $email_data['subject'] = $add_company['subject'];
                $email_data['emails'] = $emails;

                dispatch(new UpdateCompanyJob($email_data));

                // event(new ChangeCompanyStatus($email_data));

                // foreach($emails as $email){
                //     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //         Mail::to(trim($email))
                //         ->bcc('poterop744@larland.com')
                //         ->send(new CompanyCreated($email_data));
                //     }
                // }
                //https://www.positronx.io/laravel-cron-job-task-scheduling-tutorial-with-example/



                return redirect()->to($url_previous)->with('success',  $company->name.' is Disengaged');
            }
            return redirect()->to($url_previous)->with('danger',  'Some error');
        }
        return redirect()->to($url_previous)->with('danger',  'Company is not found');
    }

    public function Dtcompanies(Request $req) {


        $sort_by = $req->sort_by??"";

        $division = $req->has('division') ? $req->division : "" ;
        $companies = [];
        $head_title = '';
 
        if(empty($sort_by)){
            if(!empty($division)){
                $companies = Company::where('type', '=', 'Client')
                ->where('status', '=', '1')
                ->where('division', '=', $division)
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')->get();
            }else{
                $companies = Company::where('type', '=', 'Client')
                ->where('status', '=', '1')
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')
                ->get();
            }
            $head_title = 'All Active Client Companies ('.$companies->count().')';
        }

        if($sort_by == 'disengaged'){
            if(!empty($division)){
                $companies = Company::where('status', '!=', '1')
                ->where('division', '=', $division)
                 ->with('parentAccount:id,name')
                 ->with('salesPerodical')
                 ->with('companyTypes:id,name,abbreviation')
                 ->with('country:id,name,code')
                 ->with('state:id,name,abbreviation')
                 ->orderBy('name', 'ASC')->get();
            }else{
                $companies = Company::where('status', '!=', '1')
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')->get();
            }
            $head_title = 'All Disengaged Companies ('.$companies->count().')';
        }
        if($sort_by == 'readymades'){
            
            if(!empty($division)){
                $companies = Company::where('type', '=', 'Readymade')
                ->where('division', '=', $division)
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')
                ->get();
            }else{
                $companies = Company::where('type', '=', 'Readymade')
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')
                ->get();
            }
            $head_title = 'All Readymade Companies ('.$companies->count().')';
        }

        if($sort_by == 'group'){
            if(!empty($division)){
                $companies = Company::where('type', '=', 'Group')
                ->where('division', '=', $division)
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')->get();
            }else{
                $companies = Company::where('type', '=', 'Group')
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')->get();
            }
            $head_title = 'All Group Companies ('.$companies->count().')';
        }

        if($sort_by == 'awaiting-Tax-ID'){
            if(!empty($division)){
                $companies = Company::where('registration_status', '=', '3')
                ->where('division', '=', $division)
                ->with('companyFiles1')
                ->with('parentAccount:id,name')
                ->with('salesPerodical')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')
                ->get();
            }else{
                $companies = Company::where('registration_status', '=', '3')
                ->with('companyFiles')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('salesPerodical')
                ->with('state:id,name,abbreviation')
                ->orderBy('name', 'ASC')
                ->get();
            }
            $head_title = 'All Companies Waiting for Tax ID ('.$companies->count().')';
        }

        if($sort_by == 'recently-issued-Tax-ID'){
            $prev_42 = date("Y-m-d", strtotime(date('Y-m-d', time()) ." -42 days"));
            if(!empty($division)){
                $companies = Company::where('status_date', '>=', $prev_42)
                ->where('status_date', '<=', date('y-m-d'))
                ->where('division', '=', $division)
                ->with('companyFiles1')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get();
            }else{
                $companies = Company::where('status_date', '>=', $prev_42)
                ->where('status_date', '<=', date('y-m-d'))
                ->with('companyFiles1')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('salesPerodical')
                ->orderBy('name', 'ASC')
                ->get();
            }
            if(!empty($companies)){
                $head_title = 'All last 42 reg day Tax ID ('.$companies->count().')';
            }else{
                $head_title = 'All last 42 reg day Tax ID (0)';
            }
        }

        if($sort_by == 'all'){
            $companies = Company::orderBy('name', 'ASC') ->with('parentAccount:id,name')->get();
            $head_title = 'All Companies ('.$companies->count().')';
        }

        if($sort_by == 'missing-tax-returns'){
            $thisYear = @date('Y-m-d');
            $lastYear = date('Y',strtotime('- 1 year', strtotime($thisYear)));
            $last_year_tax_returns = TaxReturns::where('tax_end', 'LIKE', $lastYear.'%')->pluck('company_id')->toArray();

            if(!empty($division)){
                $companies = Company::selectRaw('Distinct companies.*')
                ->where('division', '=', $division)
                ->where('status_date', '<', $lastYear.'-12-02 00:00:00')
                ->where('status_date', '!=', 'null')
                ->where('tax_id', '!=', 'null')
                ->where('status', '=', '1')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->whereNotIn('companies.id', $last_year_tax_returns)  
                ->orderBy('name', 'ASC')->get(); 
            }else{
                $companies = Company::selectRaw('Distinct companies.*')
                ->where('tax_id', '!=', 'null')
                ->where('status', '=', '1')
                ->where('status_date', '<', $lastYear.'-12-02 00:00:00')
                ->where('status_date', '!=', 'null')
                ->with('country:id,name,code')
                ->with('state:id,name,abbreviation')
                ->with('parentAccount:id,name')
                ->with('companyTypes:id,name,abbreviation')
                ->with('salesPerodical')
                ->whereNotIn('companies.id', $last_year_tax_returns)  
                ->orderBy('name', 'ASC')->get();
            }
            $head_title = 'All Companies with Missing Tax Return  ('.$companies->count().')';
        }

        if ($req->ajax()) {
            $data = $companies;
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('open_newtax_returns', function($row){
                    return '';
                })

                ->addColumn('account_name', function($row){
                    if(!empty($row->parentAccount)){
                        return $row->parentAccount->name;
                    }
                    return ''; 
                })
                ->addColumn('country_code', function($row){
                    if(!empty($row->country)){
                        return $row->country->code;
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
