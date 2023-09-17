<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Apps;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    //

    public function index(){


        return view('app.index', [

            ]);

    }

    public function add_app(Request $req){

        $validated = Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'api_url' => ['required', 'string', 'max:255'],
            Rule::unique('apps', 'api_url'),
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validated->fails()) {
            return redirect()->route('reg_app')->with('danger', $validated->errors()->first());
        }

        $app = new Apps();
        $req['api_key'] = Str::random(50);

        $app->password = Hash::make($req['password']);
        $app->name = $req['name'];
        $app->api_url = $req['api_url'];
        $app->api_key =  $req['api_key'];

        try {
            if($app->save()){
                return redirect()->route('reg_app')->with('success', 'Your Api key -( '.$req['api_key'].' )');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->route('reg_app')->with('danger', 'This url is registered');
            } else {
                return redirect()->route('reg_app')->with('danger', 'Some error');
            }
        }
    }
}
