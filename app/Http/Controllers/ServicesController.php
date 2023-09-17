<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Services;
use DataTables;
use Auth;

class ServicesController extends Controller
{
    //

    public function index(){
        return view('user.services.index', [
            'sevices' => Services::all(),//where('user_id', Auth::user()->id)->get(),
            ]);
    }

    public function new_service(Request $req){

        $service = new Services();
        $service->title = $req->input('title');
        $service->status = $req->input('status');
        $service->currency = $req->input('currency');
        $service->price = $req->input('price');
        $service->period = $req->input('period');
        $service->invoice_description = $req->input('invoice_description');
        $service->comments = $req->input('comments');
        $service->user_id = Auth::user()->id;

        $url = url()->previous();
        if($service->save()){
            return redirect()->to($url)->with(' success',  'Service is created');
        }
        return redirect()->to($url)->with('danger',  'Service is not created');
    }

    public function delete_service($id) {
        $service = Services::find($id);
        $url = url()->previous();
        if(empty($service)){
            return redirect()->to($url)->with('danger', "Not Found");
        }
        if($service->delete()){
            return redirect()->to($url)->with('success', $service->title.' - Removed');
        }
    }

    public function edit_service(Request $req) {
        $url = url()->previous();
        
        $service = Services::find($req->input('id'));
        if(empty($service)){
            return redirect()->to($url)->with('danger',  'Service is not Founded');
        }

        $service->title = $req->input('title');
        $service->status = $req->input('status');
        $service->currency = $req->input('currency');
        $service->price = $req->input('price');
        $service->period = $req->input('period');
        $service->invoice_description = $req->input('invoice_description');
        $service->comments = $req->input('comments');
        $service->user_id = Auth::user()->id;

        if($service->save()){
            return redirect()->to($url)->with(' success',  'Service is edited');
        }
        return redirect()->to($url)->with('danger',  'Service is not edited');
    }

    public function Dtservice(Request $req){

        if ($req->ajax()) {
            $data = Services::get()->toArray();

            // dd($data);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
