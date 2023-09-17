<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LogCall;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Company;
use Auth;


class LogCallController extends Controller
{

    public function get_call($id, $url){

        $log_call = LogCall::where('id', '=', $id)->with('contacts')->with('account')->with('company')->with('user:id,first_name,last_name')->with('updateUser:id,first_name,last_name')->get()->first();
        $url_ = url()->previous();
        if(empty($log_call)){
            return redirect()->to($url_)->with('danger',  'Call is not found');
        }

        return view('notifications.call', [
            'accounts' => Account::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies' => Company::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::all('id', 'title','first_name', 'last_name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'title','first_name', 'last_name']),
            'users' => User::all(['id', 'first_name', 'last_name', 'email']),
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'log_call' => $log_call,
            'url' => $url
        ]);
    }

    public function add_log_call(Request $req){
        $url = url()->previous();
        $data = new LogCall();
        $data->contact_id = $req->input('contact_id');
        $data->company_id = $req->input('company_id');
        $data->subject = $req->input('subject');
        $data->comments = $req->input('comments');
        $data->related_to = $req->input('related_to');
        $data->assigned_to = Auth::user()->id; 
        $data->priority = 1; 
        $data->status = 1; 
        $data->reminder_set = 0; 
        $data->create_recurring_series_of_tasks = 0; 
        $data->date = date('Y-m-d'); 
        $data->user_id = Auth::user()->id;

        if ($data->save()) {
            return redirect()->to($url)->with('success',  'Call is added');
        }
    }


    public function edit_call(Request $req){
        $id = $req->input('id');
        $url = url()->previous();

        $requests = [
                'contact_id',
                'company_id',
                'subject',
                'comments',
                'related_to',
                'assigned_to',
                'priority',
                'status',
                'reminder_set',
                'create_recurring_series_of_tasks',
                'date',
        ];

        $call = LogCall::find($id);

        foreach ($requests as $request){
            if($req->input($request)){
                $call->{$request} = $req->input($request);
            }
        }
        $call->update_user_id = Auth::user()->id;

        if ($call->save()) {
            return redirect()->to($url)->with('success',  'Call is edited');
        }
    }

    public function delete_call ($id, $url = null){
        $call = LogCall::find($id);
        $url_id  = '';
        if(!isset($url)){
            $url = url()->previous();
        }else{
            $key = $url.'_id';
            if($url == 'account'){
                $key = 'related_to';
            }
            $url_id = $call->{$key};
            $url = 'edit_'.$url;
        }

        if(empty($call)){
            if (!empty($url_id)){
                return redirect()->route($url, [$url_id])->with('danger', "Not Found");
            }
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($call->delete()){
            if (!empty($url_id)){
                return redirect()->route($url, [$url_id])->with('success',  ' Call is Deleted ');
            }
            return redirect()->to($url)->with('success',  ' Call is Deleted ');
        }
    }

}
