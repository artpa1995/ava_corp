<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Notes;
use Auth;

class NotesController extends Controller
{
    
    public function get_notes ($url,$id ){
        $column = $url.'_id';
        $notes = Notes::where($column, '=', $id)->with('contacts')->with('account')->with('company')->get();

        $page_title = '';
        $titles = [
          'account_id' => $notes->first()->account->name ?? "",
          'contact_id' => $notes->first()->contacts->title ?? "",
          'company_id' => $notes->first()->company->name ?? "",
          'event_id' => $notes->first()->event->name ?? "",
        ];
        
       if($url && $titles[$column]){
        $page_title = $titles[$column];
       }

        return view('user.notes.notes', [
            'id' => $id,
            'notes' => $notes,
            'page_title' => $page_title,
            'url' => $url
        ]);

    }

    public function add_notes (Request $req){

        $notes = new Notes();
        $requests = [
            'title',
            'content',
            'account_id',
            'contact_id',
            'company_id',
            'event_id',
        ];

        foreach ($requests as $request){
            if($req->input($request)){
                $notes->{$request} = $req->input($request);
            }
        }
        $file = $req->file('note_file');
        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $notes['note_file'] = $filename;
        }

        $notes->user_id = Auth::user()->id; 
        $url = url()->previous();
        if ($notes->save()) {
            return redirect()->to($url)->with('success',  'Notes is added');
        }
    }

    public function edit_notes (Request $req, $id){

        $notes =  Notes::whereId($id)->first();
        $requests = [
            'title',
            'content',
        ];

        foreach ($requests as $request){
            if($req->input($request)){
                $notes->{$request} = $req->input($request);
            }
        }

        $file = $req->file('note_file');
        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $notes['note_file'] = $filename;
        }
        $notes->user_id = Auth::user()->id; 
        $url = url()->previous();
        if ($notes->save()) {
            return redirect()->to($url)->with('success',  'Notes is edited');
        }

    }

    public function delete_notes($id){
        $notes = Notes::find($id);
    
        $url = url()->previous();
        if(empty($notes)){
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($notes->delete()){
            return redirect()->to($url)->with('success',  ' Notes is Deleted ');
        }
    }

}
