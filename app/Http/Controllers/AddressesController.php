<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AddressRelation;
use App\Models\AddressProvider;
use App\Models\CountryState;
use App\Models\County;

// use App\Models\CompanyType;
use App\Models\Address;
// use App\Models\Account;
// use App\Models\Company;
// use App\Models\Contact;
use App\Models\Country;
// use App\Models\User;
use App\Models\Options;
use DataTables;
use Auth;

class AddressesController extends Controller
{
    //

    public function index (){

        $user_id = Auth::user()->id;

        return view('user.address.index', [
           'addresses' => Address::/*where('user_id', $user_id)->*/with('addressProvider')->with('state.county')->with('country')->with('county')->get(),
           'countries' => Country::all(),
           'stateis' => CountryState::all(),
           'address_providers' => AddressProvider::all(),//where('user_id', '=', Auth::user()->id)->get(),
        ]);

    }

    public function edit ($id){

        return view('user.address.edit_address', [
            'address' => Address::where('id', '=', $id) ->with('addressProvider')->get()->first(),
            'countries' => Country::all(),
            'stateis' => CountryState::all(),
            'address_providers' => AddressProvider::all(),//where('user_id', '=', Auth::user()->id)->get(),
         ]);
    }

    public function update (Request $req, $id = null){

        if(!$id){
            $id = $req->input('address_id');
        }
        $url = url()->previous();
        $address = Address::find($id);
        $address->title = $req->input('title');
        $address->country_id = $req->input('country_id');
        $address->state_id = $req->input('state_id');
        $address->county_id = $req->input('county_id');
        $address->city = $req->input('city');
        $address->address_provider  = $req->input('address_provider');
        $address->address_1 = $req->input('address_1');
        $address->address_2 = $req->input('address_2');
        $address->address_3 = $req->input('address_3');
        $address->street = $req->input('street');
        $address->house_number = $req->input('house_number');
        $address->post_code_zip = $req->input('post_code_zip');
        $address->region = $req->input('region');
        $address->user_id = Auth::user()->id;

        if($req->input('county_id') && !$req->input('state_id')){
           $county =  County::where('id', '=', $req->input('county_id'))->get(['state_id'])->first();
           $address->state_id = $county->state_id;
        }

        if(!empty($req->input('address_provider'))){
            $address->entery_type = null;
        }

        if( $address->save()){
            return redirect()->to($url)->with('success',  'Address is edited');
        }

    }

    public function delete_address ($id){

        $address = Address::find($id);
        if(empty($address)){
            return redirect()->route('addresses')->with('danger', "Not Found");
        }
        if($address->delete()){
            return redirect()->route('addresses')->with('success', $address->title.' - Removed');
        }
    }

    public function add_address(Request $req){

        $address = new Address();
  
        $address->title = $req->input('title');
        $address->country_id = $req->input('country_id');
        $address->state_id = $req->input('state_id');
        $address->city = $req->input('city');
        $address->address_provider  = $req->input('address_provider');
        $address->address_1 = $req->input('address_1');
        $address->address_2 = $req->input('address_2');
        $address->address_3 = $req->input('address_3');
        $address->street = $req->input('street');
        $address->house_number = $req->input('house_number');
        $address->post_code_zip = $req->input('post_code_zip');
        $address->county_id = $req->input('county_id');
        $address->user_id = Auth::user()->id;
        
        if( $address->save()){
            return redirect()->route('addresses')->with('success', $req->input('title').' - Added');
        }
    }

    public function get_states(Request $req){
        $states = CountryState::where('country_id', '=', $req->id)
        ->with('county')
        ->get();
        if(!empty($states[0])){
            return response()->json(['code' => 200, 'msg' => $states]);
        }
        return response()->json(['code' => 400, 'msg' => 'No Data']);
    }


    public function add_relation_address(Request $req){
        $url = url()->previous();

        // if($req->input('address_provider')){
        //     $address = Address::find($req->input('address_id'));
        //     $address->address_provider = $req->input('address_provider');
        //     $address->save();
        // }

        $data_id =  $req->input('page_url').'_id';
        AddressRelation::where($data_id, '=', $req->input('page_id'))->update(["address_type" => null]);

        $address_relation = AddressRelation::where($data_id, '=', $req->input('page_id'))
        // ->where('address_id', '=', $req->input('address_id'))
        ->where('id', '=', $req->input('relation_address_id'))
        ->get()
        ->first();

        if(empty($address_relation)){
            $address_relation = new AddressRelation();
        }
        $address_relation->{$data_id} = $req->input('page_id');
        $address_relation->address_id = $req->input('address_id');
        $address_relation->address_type = $req->input('address_type');
        $address_relation->provider_id = $req->input('address_provider');
        $address_relation->user_id = Auth::user()->id;

        if($req->input('manual_entry_or_address_provider') == 2 ){
            $address_relation->address_id = $this->update_manual_address($req);
        }

        if($address_relation->save()){
            return redirect()->to($url)->with('success', 'Main address is edited');
        }
        return redirect()->to($url)->with('danger', 'Address some error');
     }

     public function update_manual_address($req){

        $address = new Address();
        if($req->input('entery_manual') == 2){
            $address = Address::find($req->address_id);
        }
        $manual_street = $req->input('manual_street') ? $req->input('manual_street').',' : "";
        $address->title = $manual_street.$req->input('manual_address2');
        $address->country_id = $req->input('country_id');
        $address->city = $req->input('manual_city');
        $address->address_provider  = $req->input('address_provider');
        $address->address_1 = $req->input('manual_address1');
        $address->address_2 = $req->input('manual_address2');
        $address->address_3 = $req->input('manual_address3');
        $address->post_code_zip = $req->input('manual_zip_code');
        $address->region = $req->input('manual_region');
        $address->street = $req->input('manual_street');
        $address->house_number = $req->input('house_number');
        $address->entery_type = 'manual';
        $address->state_id = $req->input('state_id');;
        $address->county_id = $req->input('county_id');;

        $address->user_id = Auth::user()->id;
        if( $address->save()){
           return $address->id;
        }

        return false;
     }

     public function new_relation_address(Request $req){

        $url = url()->previous();

        $data_id =  $req->input('page_url').'_id';
        if($req->input('address_type')){
            AddressRelation::where($data_id, '=', $req->input('page_id'))->update(["address_type" => null]);
        }

        $address_relation = new AddressRelation();
      
        $address_relation->{$data_id} = $req->input('page_id');
        $address_relation->address_id = $req->input('address_id');
        $address_relation->address_type = $req->input('address_type');
        $address_relation->provider_id = $req->input('address_provider');
        $address_relation->user_id = Auth::user()->id;

        if($req->input('manual_entry_or_address_provider') && $req->input('manual_entry_or_address_provider') == 2){
            $new_address = $this->add_address_manual($req);
            if($new_address){
                $address_relation->address_id = $new_address->id;
                $address_relation->entery_type = 'manual';
            }
        }
        if(!$address_relation->address_id){
            return redirect()->to($url)->with('danger', 'Address some error');
        }

        if($address_relation->save()){
            return redirect()->to($url)->with('success', 'Main address is created');
        }
        return redirect()->to($url)->with('danger', 'Address some error');

     }

     public function add_address_manual($data){
 
        $address = new Address();
  
        $manual_street = $data->input('manual_street') ? $data->input('manual_street').',' : "";
        $address->title = $manual_street.$data->input('manual_address2');
        $address->country_id = $data->input('country_id');
        $address->city = $data->input('manual_city');
        $address->address_1 = $data->input('manual_address1');
        $address->address_2 = $data->input('manual_address2');
        $address->address_3 = $data->input('manual_address3');
        $address->post_code_zip = $data->input('manual_zip_code');
        $address->region = $data->input('manual_region');
        $address->street = $data->input('manual_street');
        $address->house_number = $data->input('house_number');
        $address->user_id = Auth::user()->id;
        $address->entery_type = 'manual';
        $address->state_id = $data->input('state_id');;
        $address->county_id = $data->input('county_id');;
        
        if( $address->save()){
            return $address;
        }
        return false;
    }


     public function address_by_url($url, $id){
         $user_id = Auth::user()->id;
         return view('user.address.by_page', [
             'addresses' => AddressRelation::/*where('user_id', $user_id)->*/where($url."_id", $id)->with('addresses.addressProvider')->get(),
             'countries' => Country::all(),
             'stateis' => CountryState::all(),
             'address_providers' => AddressProvider::all(),//where('user_id', '=', Auth::user()->id)->get(),
             'url' => $url,
             'id' => $id
         ]);
     }

     public function update_options(Request $req){

        $url = url()->previous();
        $datas = [
            'address_1',
            'address_2',
            'city',
            'zip',
            'state'
        ];

        foreach($datas as $data){
            if($req->{$data}){
                $option =  Options::where('option_key', '=', $data)->get()->first();
                if(empty($option)){
                    $option = new Options();
                }

                $option->user_id = Auth::user()->id;
                $option->option_key = $data;
                $option->option_value = $req->{$data};
                $option->save();

            }
        }
        return redirect()->to($url)->with('success',  'IRS Standard Correspondence Address is edited');

    }

    public function show_IRS_Standard_Correspondence_Address(){

        $user_id = Auth::user()->id;

        $options = [];
        $datas = [
            'address_1',
            'address_2',
            'city',
            'zip',
            'state'
        ];
        foreach($datas as $data){
            $option =  Options::where('option_key', '=', $data)->get()->first();
            $options[$data] =  $option->option_value ?? '';
        }


        return view('user.address.IRS_Standard_Correspondence_Address', [
           'options' => $options,
           'stateis' => CountryState::all(),
         
        ]);

    }


    public function Dtall_addresses(Request $req){

        if ($req->ajax()) {
            $data = Address::with('addressProvider:id,title')->with('state.county')->with('country:id,name')->with('county:id,name')->get()->toArray();

            // dd($data);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('addressProvider_sort', function($row){
                    if($row['address_provider'] && $row['address_provider']['title']){
                        return $row['address_provider']['title'];
                    }
                    return '';
                })

                ->addColumn('state_county', function($row){
                    if($row['county'] && $row['county']['name']){
                        return $row['county']['name'];
                    }
                    if($row['state'] && $row['state']['name']){
                        return $row['state']['name'];
                    }
                    return '';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //  public function add_relation_address(Request $req){
    //     $data_id =  $req->input('page_url').'_id';
    //     $address_relation = AddressRelation::where($data_id, '=', $req->input('page_id'))->get()->first();
    //     if(empty($address_relation)){
    //         $address_relation = new AddressRelation();
    //     }
       
    //     $address_relation->{$data_id} = $req->input('page_id');
    //     $address_relation->address_id = $req->input('address_id');
    //     $address_relation->address_type = $req->input('address_type');
    //     $address_relation->user_id = Auth::user()->id;

    //     if($address_relation->save()){
    //         return response()->json(['code' => 200, 'msg' => $address_relation]);
    //       }
    //       return response()->json(['code' => 400, 'msg' => 'No Data']);
    //  }

}
