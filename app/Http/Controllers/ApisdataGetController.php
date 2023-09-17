<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApisdataGetController extends Controller
{
    public function getDatafrom(Request $req)
    {
       
        $sites = [
            // 'shopify'  =>  ShopifyZapierController::getDatafrom($req),
            'wordpress' => WordpressDataController::getDatafrom($req),
         ]; 

         if($req->site){
            return $sites[$req->site];
         }
      
         return 'error';
    }
}
