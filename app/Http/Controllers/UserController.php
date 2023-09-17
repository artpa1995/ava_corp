<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $user;

    public function __construct(){
        $this->user = Auth::user();
    }

    public function profile(){
        return view('user.profile.profile');
    }

    public function update_profile(Request $request){

        $user =  Auth::user();
 
        $validated = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        if($request->password != $request->confirm_password){
            return response()->json(['code' => 400, 'msg' => 'Passwords do not match']);
        }
      
        if(!empty($request->password) && !empty($request->confirm_password) && !empty($request->old_password)){
            $validated = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'password' => ['', 'string', 'max:255'],
                'confirm_password' => ['', 'string', 'max:255'],    
                'old_password' => '',
            ]);
            if(Hash::check($request->old_password, $user->password)){
               $this->change_password($request->password);
            }else{
                return response()->json(['code' => 400, 'msg' => 'Old password is not correct']);
            }
        }

        if ($user->avatar == null) {
             $validate_image = Validator::make($request->all(), [
                'profile_image' => ['required', 'image', 'max:10000']
            ]);
        }
 
        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }
 
        if ($request->hasFile('profile_image')) {
            $imagePath = 'storage/'.auth()->user()->profile_image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $profile_image = $request->profile_image->store('profile_image', 'public');
        }

        $user->avatar = $profile_image ?? $user->avatar ;

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'avatar' => $profile_image ?? $user->avatar 
        ]);
        return response()->json(['code' => 200, 'msg' => 'profile updated successfully.']);
    }
        
    public function change_password($password){
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($password),
        ]);
        return true;
    }
    
}
