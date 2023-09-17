<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register_app(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'status' => '0',
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login_app(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    } 
    
    
    
}