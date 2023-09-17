<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Passport\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class PassportClientController extends Controller
{
    
    public function create (Request $request){

        $secret = Str::random(40);
        $client = Client::create([
            'name' => 'shopifya',
            'redirect' => 'https://ava/auth/callback',
            'secret'=> $secret,
            'personal_access_client' => false,
            'password_client' => false,
            'revoked' => false,
        ]);
        
       
        $request->session()->put('client_id', $client->id);
        $request->session()->put('client_secret', $secret);
        
        return redirect('https://ava/redirect');

    }

     public function redirect_client(Request $request){

        $request->session()->put('state', $state = Str::random(40));

        $client_id = $request->session()->pull('client_id');
        $query = http_build_query([
            'client_id' => $client_id,
            'redirect_url' => 'https://ava/auth/callback',
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);
        
        $request->session()->put('client_id', $client_id);
    
        return redirect('https://ava/oauth/authorize?'.$query);

    }

    public function auth_callback(Request $request)
    {
        
        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );
    
        $client_id = $request->session()->pull('client_id');
        $client_secret = $request->session()->pull('client_secret');
        
        $response = Http::asForm()->post('https://ava/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_url' => 'https://ava/auth/callback',
            'code' => $request->code,
            ]);
        dump($client_id);
        dump($client_secret);    
        dump($response->json());
        dump($response->json()['access_token']);
        return $response->json()['access_token'];
    }
}
