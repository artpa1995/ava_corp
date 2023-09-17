<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Client;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive;
use Auth;

class GoogleDriveController extends Controller
{
    public function upload_form(){
        return view('upload_form');
    }
    
    public function auth_google() {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
     
        $authUrl = $client->createAuthUrl();
     
        return redirect($authUrl);
    }
    
    public function callback() {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
     
        if (request()->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode(request()->code);
    
            if (!empty($token['access_token'])) {
                $client->setAccessToken($token['access_token']);
    
                $credentialsPath = storage_path('app/google/token.json');
                if (!file_exists(dirname($credentialsPath))) {
                    mkdir(dirname($credentialsPath));
                }
                file_put_contents($credentialsPath, json_encode($token));
    
                return redirect()->route('google.drive.list');
            }
        }
    
        return redirect()->route('google.drive.auth');
    }
    
    public function list(){
        
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
    
        // Load the access token from the file
        $accessToken = json_decode(Storage::get('google/token.json'), true)['access_token'];
    
        $client->setAccessToken($accessToken);
    
        $service = new Google_Service_Drive($client);
    
        $files = $service->files->listFiles();
    
        return view('google_drive', ['files' => $files]);
    }
    
    public function upload(Request $request){
    $client = new Google_Client();
    
    $client->setAuthConfig(env('GOOGLE_DRIVE_CREDENTIALS_PATH'));
    $client->setScopes([Google_Service_Drive::DRIVE_FILE]);

    // $client->addScope(Google_Service_Drive::DRIVE_FILE);
    $client->setAccessType('offline');

    // Load the access token from the file
    $accessToken = json_decode(Storage::get('google/token.json'), true)['access_token'];

    $client->setAccessToken($accessToken);

    $service = new Google_Service_Drive($client);

    // $fileMetadata = new Google_Service_Drive_DriveFile(array(
    //     'name' => $request->file('file')->getClientOriginalName(),
    // ));

    // $content = file_get_contents($request->file('file')->getRealPath());

    // $file = $service->files->create($fileMetadata, array(
    //     'data' => $content,
    //     'uploadType' => 'multipart',
    //     'fields' => 'id',
    // ));
    $driveService = new Drive($client);
    
    $fileMetadata = new DriveFile();
    $fileMetadata->setName('My File');
    $file = $driveService->files->create($fileMetadata, array(
        'data' => file_get_contents($request->file('file')->getRealPath()),
        'uploadType' => 'multipart'
    ));
    
    // Get the link to the uploaded file
    $link = $file->getWebViewLink();
    
    $fileId = $file->getId();

// Construct the web link URL for the file
    $link = sprintf('https://drive.google.com/file/d/%s/view', $fileId);

    return redirect('/google-drive-list')->with('message', 'File uploaded successfully!');
}


    public function create_folder($name){
        $client = new Google_Client();
    
        $client->setAuthConfig(env('GOOGLE_DRIVE_CREDENTIALS_PATH'));
        $client->setScopes([Google_Service_Drive::DRIVE_FILE]);
        // $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
    
        // Load the access token from the file
        $accessToken = json_decode(Storage::get('google/token.json'), true)['access_token'];
    
        $client->setAccessToken($accessToken);

        $service = new \Google_Service_Drive($client);

        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder'
        ));
        $folder = $service->files->create($fileMetadata, array(
            'fields' => 'id'
        ));
        
        return ['id'=> $folder->id];
    }
    
    public function add_file($data){
        $client = new Google_Client();
        
        $client->setAuthConfig(env('GOOGLE_DRIVE_CREDENTIALS_PATH'));
        $client->setScopes([Google_Service_Drive::DRIVE_FILE]);
        $client->setAccessType('offline');

        $accessToken = json_decode(Storage::get('google/token.json'), true)['access_token'];
    
        $client->setAccessToken($accessToken);
    
        $service = new Google_Service_Drive($client);

        $driveService = new Drive($client);
        
        $fileMetadata = new DriveFile();
        $fileMetadata->setName($data['name']);
        $file = $driveService->files->create($fileMetadata, array(
            'data' => file_get_contents($data['file']),
            'uploadType' => 'multipart'
        ));
        $link = $file->getWebViewLink();
        
        $fileId = $file->getId();
        $link = sprintf('https://drive.google.com/file/d/%s/view', $fileId);

        return ['link'=> $link];
    }
    
}
