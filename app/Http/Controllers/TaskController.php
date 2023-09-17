<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Company;
use Auth;

class TaskController extends Controller
{

    public function get_task($id, $url){

        $task = Task::where('id', '=', $id)->with('contacts')->with('account')->with('company')->with('user:id,first_name,last_name')->with('updateUser:id,first_name,last_name')->get()->first();
        $url_ = url()->previous();
        if(empty($task)){
            return redirect()->to($url_)->with('danger',  'Call is not found');
        }

        return view('notifications.task', [
            'accounts' => Account::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies' => Company::all('id', 'name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::all('id', 'title', 'first_name', 'last_name'),//where('user_id', '=', Auth::user()->id)->get(['id', 'title', 'first_name', 'last_name']),
            'users' => User::all(['id', 'first_name', 'last_name', 'email']),
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'task' => $task,
            'url' => $url
        ]);
    }

    public function add_task(Request $req){
        $url = url()->previous();
        $data = new Task();
        $data->contact_id = $req->input('contact_id');
        $data->company_id = $req->input('company_id');
        $data->subject = $req->input('subject');
        $data->related_to = $req->input('related_to');
        $data->assigned_to = $req->input('assigned_to');
        $data->priority = 1;
        $data->status = 1; 
        $data->reminder_set = 0; 
        $data->create_recurring_series_of_tasks = 0; 
        $data->date = $req->input('date'); 
        $data->user_id = Auth::user()->id;

        if ($data->save()) {
            return redirect()->to($url)->with('success',  'New Task Created');
        }
    }

    public function edit_task(Request $req){
        $id = $req->input('id');
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

        $url = url()->previous();
        $task = Task::find($id);

        foreach ($requests as $request){
            if($req->input($request)){
                $task->{$request} = $req->input($request);
            }
        }
        $task->update_user_id = Auth::user()->id;

        if ($task->save()) {
            return redirect()->to($url)->with('success',  'Task is edited');
        }
    }

    public function delete_task ($id, $url = null){

        $task = Task::find($id);
        $url_id  = '';
        if(!isset($url)){
            $url = url()->previous();
        }else{
            $key = $url.'_id';
            if($url == 'account'){
                $key = 'related_to';
            }
            $url_id = $task->{$key};
            $url = 'edit_'.$url;
        }

        if(empty($task)){
            if (!empty($url_id)){
                return redirect()->route($url, [$url_id])->with('danger', "Not Found");
            }
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($task->delete()){
            if (!empty($url_id)){
                return redirect()->route($url, [$url_id])->with('success',  ' Task is Deleted ');
            }
            return redirect()->to($url)->with('success',  ' Task is Deleted ');
        }
    }

}
