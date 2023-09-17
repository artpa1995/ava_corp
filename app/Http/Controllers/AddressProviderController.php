<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddressProvider;
use App\Models\Address;
use App\Models\User;
use Auth;

class AddressProviderController extends Controller
{
    
    public function index(){
        $id = Auth::user()->id;
    return view('user.address.address_providers', [ 'address_providers' => AddressProvider::all()/*where('user_id', $id)->get()*/]);
    }

    public function add_address_providers(Request $req){
        $address_provider = new AddressProvider;
        $address_provider->title = $req->input('title');
        $address_provider->user_id = Auth::user()->id;
        $address_provider->save();

        $url = url()->previous();
        if($address_provider->save()){
                    return redirect()->to($url)->with('success',  'Address Providers is created');
                }
        return redirect()->to($url)->with('danger',  'Address some error');
    }

    public function update(Request $req){
        $url = url()->previous();
        $address_provider = AddressProvider::find($req->input('id'));
        $user_id = Auth::user()->id;

        if($address_provider && $address_provider->user_id == $user_id){
            $address_provider->title = $req->input('title');

            if($address_provider->save()){
                return redirect()->to($url)->with('success',  'Address Providers is edited');
            }
            return redirect()->to($url)->with('danger',  'Address Providers some error');
        }
        return redirect()->to($url)->with('danger',  'Address Providers is not found');
    }

    public function delete_address_provider(Request $req, $id){
        $addresses = Address::where('address_provider', '=', $id)->get()->first();
        $url = url()->previous();
        if(empty($addresses->id)){
            $address_provider = AddressProvider::find($id);
            if($address_provider->delete()){
                return redirect()->to($url)->with('success',  'Address Provider is removed');
            }
            return redirect()->to($url)->with('danger',  'Address Provider is not removed');
        }
        return redirect()->to($url)->with('danger',  'This Address Provider is used in addresses');  
    }
}
