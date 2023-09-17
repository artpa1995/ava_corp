<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Files;
use App\Models\FileReations;
use Auth;

class FilesController extends Controller
{
    public function search_file (Request $req){

        if($req->ajax()){
            $search =  $req->input('value');

            $files = FileReations::where('user_id', '=', Auth::user()->id)
            ->whereHas('file', function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->with(['file' => function($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%');
            }])
            ->get();

            return response()->json($files);
        }

    }

    public function get_files (Request $req, $url, $id){
        $column = $url.'_id';
        $files = FileReations::where($column, '=', $id )->with('file')->get();
       
        $page_title = '';
        $titles = [
          'account_id' => $files->first()->account->name ?? "",
          'contact_id' => $files->first()->contacts->title ?? "",
          'company_id' => $files->first()->company->name ?? "",
          'event_id' => $files->first()->event->name ?? "",
        ];
        
        if($url && $titles[$column]){
            $page_title = $titles[$column];
        }

        return view('user.files.files', [
            'id' => $id,
            'files' => $files,
            'page_title' => $page_title,
            'url' => $url,
            'files_data' => FileReations::/*where('user_id', '=', Auth::user()->id)->*/with('file')->get(),
        ]);

    }

    public function add_files (Request $req){
        $files = new Files();
        $fileReations = new FileReations();
        $file = $req->file('file');
        $url = url()->previous();
        
        if($file){
            $files->name = $file->getClientOriginalName();
            $files->size = $file->getSize();
            $files->type = $file->getMimeType();
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $files['path']= $filename;
        }else{
            return redirect()->to($url)->with('danger',  'Please upload file');
        }

        $files->save();

        $fileReations->file_id = $files->id;
        $requests = [
            'account_id',
            'contact_id',
            'company_id',
            'event_id',
        ];

        foreach ($requests as $request){
            if($req->input($request)){
                $fileReations->{$request} = $req->input($request);
            }
        }

        $fileReations->user_id = Auth::user()->id; 
        $fileReations->status = 1; 
      
        if ($fileReations->save()) {
            return redirect()->to($url)->with('success',  'Files is added');
        }
    }

    public function edit_files (Request $req){
        $url = url()->previous();
        $requests = [
            'account_id',
            'contact_id',
            'company_id',
            'event_id',
        ];

        $isset_file = [];

        $success = '';
      
        foreach($req->input('file') as $file){
           
            $fileReations = new FileReations();
            $flag = 1;

            foreach ($requests as $request){
                $page_id = $req->input($request);

                if($req->input($request)){
                    $isset_file_data = FileReations::where('file_id', '=', $file)->where($request, '=', $page_id)->with('file')->get()->first();
                  
                    if($isset_file_data){
                        if($isset_file_data){
                            $isset_file[] = $isset_file_data->file->name;
                            $flag = 0;
                            continue;
                        } 
                    }

                    $fileReations->{$request} = $req->input($request);
                }else{
                    $fileReations->{$request} = null;
                }
            }
            $fileReations->file_id = $file;
            $fileReations->user_id = Auth::user()->id; 
            $fileReations->status = 1;
            if($flag){
                $fileReations->save();
                $success = 1;
            }
        }
        if(count($isset_file) &&  $success){
            return redirect()->to($url)->with('danger', implode(", ", $isset_file)." is isset")->with('success',  ' files is Deleted ');
        }elseif(count($isset_file) && !$success){
            return redirect()->to($url)->with('danger', implode(", ", $isset_file)." is isset");
        }elseif(!count($isset_file) && $success){
            return redirect()->to($url)->with('success',  'Files is added');
        }
    }

    public function delete_files($id){
        $files = FileReations::find($id);
    
        $url = url()->previous();
        if(empty($files)){
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($files->delete()){
            return redirect()->to($url)->with('success',  ' Files is Deleted ');
        }
    }
}

