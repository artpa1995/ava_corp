<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AccountSendEmail;
use App\Models\AddressRelation;
use App\Models\AddressProvider;
use App\Models\FollowingCompany;
use App\Models\FileReations;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Address;
use App\Models\Country;
use App\Models\Files;
use App\Models\Notes;
use App\Models\User;
use DataTables;
use Auth;

class ContactsController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        return view('user.contact.contacts', [
            'contacts' => Contact::all(),//where('user_id', $id)->get(),
            'accounts' =>Account::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id','name']), //Account::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id','first_name', 'last_name', 'email']),
        ]);
    }

    public function contacts_by_account($id){
        return view('user.contact.contacts', [
            'contacts' => Contact::where('account_id', $id)->get(),
            'accounts' =>Account::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id','first_name', 'last_name', 'email']),
        ]);
    }

    public function add_contact(Request $req){

        $data = new Contact();

        $data->user_id = Auth::user()->id;
        $data->owner_id = $req->input('owner_id');
        $data->solution = $req->input('solution');
        $data->account_id = $req->input('account_id');
        $data->first_name = $req->input('first_name');
        $data->last_name = $req->input('last_name');
        $data->middle_name = $req->input('middle_name');
        $data->suffix = $req->input('suffix');
        $data->phone = $req->input('phone');
        $data->fax = $req->input('fax');
        $data->reports = $req->input('reports');
        $data->email = $req->input('email');
        $data->title = $req->input('title');
        $data->mobile = $req->input('mobile');
        $data->department = $req->input('department');
        $data->mailing_address = $req->input('mailing_address');
        $data->mailing_street = $req->input('mailing_street');
        $data->mailing_city = $req->input('mailing_city');
        $data->mailing_state = $req->input('mailing_state');
        $data->mailing_country = $req->input('mailing_country');
        $data->mailing__zip_code = $req->input('mailing__zip_code');
        $data->email_1 = $req->input('email_1');
        $data->email_2 = $req->input('email_2');
        $data->email_3 = $req->input('email_3');
        $data->email_4 = $req->input('email_4');
        $data->phone_1 = $req->input('phone_1');
        $data->phone_2 = $req->input('phone_2');
        $data->phone_3 = $req->input('phone_3');
        $data->phone_4 = $req->input('phone_4');
        $data->job_title = $req->input('job_title');

        if($data->save()){
            return redirect()->route('contacts')->with('success', $req->input('last_name') .' '.$req->input('first_name').' - Added');
        }

    }

    public function edit_contact(Request $req, $id){
        $contact = Contact::find($id);

        if(empty($contact)){
            return redirect()->route('contacts')->with('danger', "Not Found");
        }

        if ($_POST){
                $contact->user_id = Auth::user()->id;
                $contact->owner_id = $req->input('owner_id');
                $contact->solution = $req->input('solution') !== "0" ? $req->input('solution') : 0 ;
                $contact->account_id = $req->input('account_id');
                $contact->first_name = $req->input('first_name');
                $contact->last_name = $req->input('last_name');
                $contact->middle_name = $req->input('middle_name');
                $contact->suffix = $req->input('suffix');
                $contact->phone = $req->input('phone');
                $contact->fax = $req->input('fax');
                $contact->reports = $req->input('reports');
                $contact->email = $req->input('email');
                $contact->title = $req->input('title');
                $contact->mobile = $req->input('mobile');
                $contact->department = $req->input('department');
                $contact->mailing_address = $req->input('mailing_address');
                $contact->mailing_street = $req->input('mailing_street');
                $contact->mailing_city = $req->input('mailing_city');
                $contact->mailing_state = $req->input('mailing_state');
                $contact->mailing_country = $req->input('mailing_country');
                $contact->mailing__zip_code = $req->input('mailing__zip_code');
                $contact->email_1 = $req->input('email_1');
                $contact->email_2 = $req->input('email_2');
                $contact->email_3 = $req->input('email_3');
                $contact->email_4 = $req->input('email_4');
                $contact->phone_1 = $req->input('phone_1');
                $contact->phone_2 = $req->input('phone_2');
                $contact->phone_3 = $req->input('phone_3');
                $contact->phone_4 = $req->input('phone_4');
                $contact->job_title = $req->input('job_title');

                if ($contact->save()) {
                    return redirect()->route('edit_contact', [$id])->with('success',$req->input('last_name') .' '.$req->input('first_name') . ' - Edited');
                }
        }
        $notifications = new NotificationController;

        return view('user.contact.edit_contact', [
            'contact' => $contact,
            'accounts' => Account::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies' =>Company::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::all('id', 'title', 'first_name', 'last_name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'title', 'first_name', 'last_name']),
            'users'=> User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name','email']),
            'emails' => AccountSendEmail::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'notifications'=> $notifications->notifications('contact_id',$id),
            'companies_count' => Company::/*where('user_id', '=', Auth::user()->id)->*/where('contact_id', '=', $id)->get(['id', 'name']),
            'contacts_count' => Contact::all(),//where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'upcoming_overdues' => $notifications->UpcomingOverdue('contact_id',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'url' => 'contact',
            'id' => $id,
            'page_title' => $contact->title,
            'notes' => Notes::where('contact_id', '=', $id)->get(),
            'files' => FileReations::where('contact_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::/*where('user_id', '=', Auth::user()->id)->*/with('file')->get(),
            'countries' => Country::all(),
            'address_providers' => AddressProvider::all(),//where('user_id', '=', Auth::user()->id)->get(),
            'addresses' => Address::where('user_id', '=', Auth::user()->id)
            ->with('country')
            ->with('state')
            ->with('addressRelation')
            ->whereHas('addressRelation', function($q) use($id){$q->where('contact_id', $id);})->get(),
            'address_relations' => AddressRelation::where('contact_id', '=', $id)->with('addresses')->get(),
            'all_addresses' => Address::/*where('user_id', '=', Auth::user()->id)->*/with('country')->with('county')->with('state')->with('addressRelation')->get(),
            'following_companies' => FollowingCompany::where('contact_id', $id)->with('company:id,name,account_id,country_id,state_id')->get()->toArray(),
        ]);
    }

    public function delete_contact($id){
        $data = Contact::find($id);
        if(empty($data)){
            return redirect()->route('contacts')->with('danger', "Not Found");
        }
        if($data->delete()){
            return redirect()->route('contacts')->with('success', $data->last_name.', '. $data->first_name.' - Removed');
        }
    }

    public function Dtcontacts(Request $request) {
        if ($request->ajax()) {
            $data = Contact::with('parentAccount:id,name')->get();
            $head_title = 'All Contacts ('. $data->count().')';
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('contact_name', function($row){
                  if(!empty($row->last_name)){
                    return $row->last_name;
                  }
                  if(!empty($row->first_name)){
                    return $row->first_name;
                  }
                    return '';
                })
                ->addColumn('parent_account', function($row){
                    $parent_account = $row->parentAccount && $row->parentAccount->name?$row->parentAccount->name : "";
                    return $parent_account;
                })
                ->addColumn('additional_value', function($row) use ($head_title) {
                    return $head_title ?? '';
                })
               
                ->rawColumns(['action','parent_account','additional_value'])
                ->make(true);
        }
    }
}
