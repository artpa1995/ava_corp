<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaSecurelyController extends Controller
{
    public function file_securely($filePath){
        return response()->file($filePath);
    }
}
