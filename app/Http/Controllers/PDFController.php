<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyFile;
use App\Models\Account;
use App\Models\Company;
use App\Models\Options;
use DateTime;
use Auth;
use DB;
use PDF;

    // See documentation: https://apidocs.pdf.co
/* 
    in terminal : composer require barryvdh/laravel-dompdf
    in config/app.php : 
    'providers' => [
    Barryvdh\DomPDF\ServiceProvider::class,
    ],

    'aliases' => [
    'PDF' => Barryvdh\DomPDF\Facade::class,
    ],
*/

class PDFController extends Controller
{
    public $apy_key = 'p4@ava_3b5539593beab445902c3bac9f6f052b8e31c981cb7da8a24defb361b1d78b86f9682f88';
    
    public  $us_state_abbrevs_names = array(
        'Alabama'  => 'AL',  
        'Alaska'  => 'AK',  
        'AMERICAN SAMOA'  => 'AS',  
        'Arizona' => 'AZ',  
        'Arkansas' => 'AR',  
        'California' => 'CA',  
        'Colorado' => 'CO',  
        'Connecticut' => 'CT',  
        'Delaware' => 'DE',  
        'District of Columbia' => 'DC',  
        'FEDERATED STATES OF MICRONESIA' => 'FM',  
        'Florida' => 'FL',  
        'Georgia' => 'GA',  
        'GUAM GU' => 'GU',  
        'Hawaii' => 'HI',  
        'Idaho' => 'ID',  
        'Illinois' => 'IL',  
        'Indiana' => 'IN',  
        'Iowa' => 'IA',  
        'Kansas' => 'KS',  
        'Kentucky' => 'KY',  
        'Louisiana' => 'LA',  
        'Maine' => 'ME',
        'MARSHALL ISLANDS' => 'MH',  
        'Maryland' => 'MD',
        'Massachusetts' => 'MA',  
        'Michigan' => 'MI',  
        'Minnesota' => 'MN',  
        'Mississippi' => 'MS',  
        'Missouri' => 'MO',  
        'Montana' => 'MT',  
        'Nebraska' => 'NE',  
        'Nevada' => 'NV',  
        'New Hampshire' => 'NH',  
        'New Jersey' => 'NJ',  
        'New Mexico' => 'NM',  
        'New York' => 'NY',  
        'North Carolina' => 'NC',  
        'North Dakota' => 'ND',  
        'NORTHERN MARIANA ISLANDS' => 'MP',  
        'Ohio' => 'OH',  
        'Oklahoma' => 'OK',  
        'Oregon' => 'OR',  
        'PALAU' => 'PW',  
        'Pennsylvania' => 'PA', 
        'PUERTO RICO' => 'PR',  
        'Rhode Island' => 'RI',  
        'South Carolina' => 'SC',  
        'South Dakota' => 'SD',  
        'Tennessee' => 'TN',  
        'Texas' => 'TX',  
        'Utah' => 'UT',  
        'Vermont' => 'VT',  
        'VIRGIN ISLANDS' => 'VI',  
        'Virginia' => 'VA',  
        'Washington' => 'WA',  
        'West Virginia' => 'WV',  
        'Wisconsin' => 'WI',  
        'Wyoming'  => 'WY'  
    );


    public function pdfview(Request $req)
    {
       
        // $company_id = $req->input('company_id');
        $tax_date = '2020-01-21';// $req->input('date');
        // $tax_type= $req->input('tax_return_type');
        
        // $company = Company::where('id', '=', $company_id)->get()->first()->toArray();
        $company = Company::where('id', '=', 14)->get()->first()->toArray();
        $company['tax_return_type'] = 1;//$tax_type;
        $company['tax_date'] = $tax_date;
        $company_name = $company['name'];
        
        view()->share('company',$company);
        
        $pdf = PDF::loadView('pdfview');

        $path = public_path('/storage/public/Files/');
        $fileName = $company_name.'-'.substr($tax_date,0,4).'.pdf' ;
        
        $CompanyFile = new CompanyFile;
        $CompanyFile->user_id = Auth::user()->id; 
        $CompanyFile->company_id = 14;
        $CompanyFile->file_type = 'form_7004';
        $CompanyFile->path = asset('storage/public/Files/'.$fileName);
        

        // if($pdf->save($path . '/' . $fileName) && $CompanyFile->save()){
        //     return response()->json(['code' => 200, 'msg' => asset('storage/public/Files/'.$fileName)]);
        // }
        // return response()->json(['code' => 400, 'msg' => 'error']);

// Storage::put('public/pdf/invoice.pdf', $pdf->output());


        // return $pdf->download('pdfview.pdf');
        
        return view('pdfview');
    }

   

    public function pdf2 (){


        $url = "https://api.pdf.co/v1/pdf/info/fields";
        // $url = "https://api.pdf.co/v1/pdf/edit/delete-text";
        // $url = "https://api.pdf.co/v1/pdf/edit/add";


        // See documentation: https://apidocs.pdf.co
        $parameters = array();

        $parameters["url"] = 'https://ava/public/public/f7004.pdf';
        $parameters['info']["Title"] = "Company 1";
        $parameters['Title'] = "Companytest";
        $parameters['name'] = "Companytest";
        $parameters["async"] = false;

        $annotations =   '[]';// JSON string


        $annotationsArray = json_decode($annotations, true);

        $info = '[{
            "Title": "test"
        }]';

         $infoa = json_decode( $info, true);

        // $parameters["annotations"] = $annotationsArray;
        $parameters["info"] = $infoa;


        // $parameters["earchString"] = "▶ Go to www.irs.gov/Form7004 for instructions and the latest information";

        // $parameters["replaceString"] = "XYZ LLC";




        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);
        $json = json_decode($result, true);
        echo "<pre>";
        print_r($json);
        die;




        if (curl_errno($curl) == 0)
        {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200)
            {
                $json = json_decode($result, true);
                
                if ($json["error"] == false)
                {
                    $resultFileUrl = $json["url"];
                    
                    // Display link to the file with conversion results
                    echo "<div><h2>Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                }
                else
                {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }
            else
            {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>";
            }
        }
        else
        {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }

        // Cleanup
        curl_close($curl);

    }


    public function edit_date($date, $company){
        $url = "https://api.pdf.co/v1/pdf/edit/replace-text";
        $parameters["url"] = 'https://ava/public/public/f7004_1.pdf';
        if($company == 3){
            $parameters["url"] = 'https://ava/public/public/f7004_1company.pdf';
        }

        $parameters["searchString"] = "(Rev. December 2018)";
        $parameters["replaceString"] = $date;

        $data = json_encode($parameters);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $json = json_decode($result, true);

        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                $json = json_decode($result, true);
                $resultFileUrl = $json["url"];
                if ($json["error"] == false && $resultFileUrl){
                   
                    return  $resultFileUrl;;
                }
                else{
                    return  $json["message"];
                }
            }
            else{
                return $result ;
            }
        }
        else{
            return curl_error($curl);
        }
      
        curl_close($curl);

    }


    public function edit_pdf(Request $req){

        $tax_end = $req->input('tax_end');
        $tax_start = $req->input('tax_start');
        $tax_type= $req->input('tax_return_type');
        $company_id = $req->input('company_id');
        
        $company = Company::where('id', '=', $company_id)->get()->first()->toArray();
        $company['tax_return_type'] = 1;
        $company_name = $company['name'];

        $address1 = Options::where('option_key', '=', 'address_1')->get('option_value')->first()->toArray();
        $address2 = Options::where('option_key', '=', 'address_2')->get('option_value')->first()->toArray();
        $city = Options::where('option_key', '=', 'city')->get('option_value')->first()->toArray();
        $state = Options::where('option_key', '=', 'state')->get('option_value')->first()->toArray();
        $zip = Options::where('option_key', '=', 'zip')->get('option_value')->first()->toArray();

        $us_state_abbrevs_names = $this->us_state_abbrevs_names;
        $state['option_value'] = $us_state_abbrevs_names[$state['option_value']];
        $addresses = join(", ",[$address1['option_value'], $address2['option_value']]);
        $address_full = join(" ",[$city['option_value'],$state['option_value'], $zip['option_value'] ]);

        // dd( $state['option_value']);
        
        $value1 = 0;
        $value2 = 0;

        if($company['tax_return_type'] == 1 || $company['tax_return_type'] == 3){
            $value1 = 1;
            $value2 = 2;
        }
        if($company['company_id'] == 4){ //company_type
            $value1 = 0;
            $value2 = 9;
        }

        if($company['company_id'] == 3){ //company_type
            if($tax_type == 1){
                $value1 = 1;
                $value2 = 2;
            }
            if($tax_type == 3){
                $value1 = 0;
                $value2 = 9;
            }
        }

        $tax_end_path_end  = substr($tax_end,2,4);
        $tax_end_path_end = str_replace("-","/", $tax_end_path_end);

        $tax_end_path_start =  substr($tax_end,5);
        $tax_end_path_start = str_replace("-","/", $tax_end_path_start);


        $tax_start_path_end=  substr($tax_start,5);
        $tax_start_path_end = str_replace("-","/", $tax_start_path_end);

        $tax_start_path_start = substr($tax_start,5);
        $tax_start_path_start = str_replace("-","/", $tax_start_path_start);

        // dd(substr($tax_start,2,2));

        $newtime =  date('Y-m-d', time());

        $date = new DateTime($newtime); 
        $date->modify("-1 year");
        $nt =  $date->format("Y-m-d");
        $date = new DateTime($nt);
        
        $testDate = $date->getTimestamp();
        $date = new DateTime($tax_end);
        $testStart = $date->getTimestamp();

        $newcompany = '';
        // if($testDate < $testStart ){

        //     $newcompany = 'True';
        // }

        if($tax_start_path_start != '01/01'){
            $newcompany = 'True';
        }
        $url = "https://api.pdf.co/v1/pdf/edit/add";
        $parameters = array();

        $param_url = $this->edit_date(substr($tax_end,0,4), $company['company_id']);
        

        $parameters["url"] = $param_url;



        $fields = '[{
            "fieldName": "topmostSubform[0].Page1[0].f1_01[0]",
            "pages": "0-",
            
            "text": "'.$company_name.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_02[0]",
            "pages": "0-",
            
            "text": "'.$company['tax_id'].'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_03[0]",
            "pages": "0-",
            
            "text": "'. $addresses .'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_04[0]",
            "pages": "0-",
            
            "text": "'.$address_full.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_05[0]",
            "pages": "0-",
            
            "text": "'.$value1.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_06[0]",
            "pages": "0-",
            
            "text": "'.$value2.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_07[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_end,2,2).'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_08[0]",
            "pages": "0-",
            
            "text": "'.$tax_start_path_start.'/"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_09[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_start,2,2).'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_10[0]",
            "pages": "0-",
            
            "text": "'.$tax_end_path_start.'/"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_11[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_end,2,4).'"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_12[0]",
            "pages": "0-",
            
            "text": "0"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_13[0]",
            "pages": "0-",
            
            "text": "00"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_14[0]",
            "pages": "0-",
            
            "text": "0"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_15[0]",
            "pages": "0-",
            
            "text": "00"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_16[0]",
            "pages": "0-",
            
            "text": "0"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_17[0]",
            "pages": "0-",
            
            "text": "00"
        },


        {
            "fieldName": "topmostSubform[0].Page1[0].c1_1[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_2[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_3[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[0]",
            "pages": "0-",
            "text": "'.$newcompany.'",
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[1]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[2]",
            "pages": "0-",
            "text": "",
            "value":"1" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[3]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[4]",
            "pages": "0-",
            
            "value":"true" 
        }]';
        
        $fieldsArray = json_decode($fields, true);
        
        $parameters["fields"] = $fieldsArray;

        $data = json_encode($parameters);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($curl);
        $json = json_decode($result, true);

        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                $json = json_decode($result, true);
                $resultFileUrl = $json["url"];

                if ($json["error"] == false && $resultFileUrl){
                    return response()->json(['code' => 200, 'msg' => $resultFileUrl]);
                }
                else{
                    return  $json["message"];
                }
            }
            else{
                return $result ;
            }
        }
        else{
            return curl_error($curl);
        }
        curl_close($curl);

    }


    public function edit_date_4868($date){
        $url = "https://api.pdf.co/v1/pdf/edit/replace-text";
        $parameters["url"] = 'https://ava/public/public/f4868.pdf';

        $parameters["searchString"] = "2022";
        $parameters["replaceString"] = $date;

        $data = json_encode($parameters);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $json = json_decode($result, true);

        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                $json = json_decode($result, true);
                $resultFileUrl = $json["url"];
                if ($json["error"] == false && $resultFileUrl){
                   
                    return  $resultFileUrl;;
                }
                else{
                    return  $json["message"];
                }
            }
            else{
                return $result ;
            }
        }
        else{
            return curl_error($curl);
        }
      
        curl_close($curl);

    }








    public function edit_pdf_4868(Request $req){

        $tax_end = $req->input('tax_end');
        $tax_start = $req->input('tax_start');
        if(empty($tax_end) || empty($tax_start)){
            return response()->json(['code' => 400, 'msg' => 'Please set Tax Year Start Date and Tax Year End Date']);
        }
        $tax_type= $req->input('tax_return_type');
        $account_id = $req->input('account_id');
        
        $account = Account::where('id', '=', $account_id)->get()->first()->toArray();
        $account['tax_return_type'] = 1;
        $account_name = $account['name'];

        $address1 = Options::where('option_key', '=', 'address_1')->get('option_value')->first()->toArray();
        $address2 = Options::where('option_key', '=', 'address_2')->get('option_value')->first()->toArray();
        $city = Options::where('option_key', '=', 'city')->get('option_value')->first()->toArray();
        $state = Options::where('option_key', '=', 'state')->get('option_value')->first()->toArray();
        $zip = Options::where('option_key', '=', 'zip')->get('option_value')->first()->toArray();


        $addresses = join(", ",[$address1['option_value'], $address2['option_value']]);
        $address_full = join(" ",[$city['option_value'],$state['option_value'], $zip['option_value'] ]);
        $us_state_abbrevs_names = $this->us_state_abbrevs_names;
        $state['option_value'] = $us_state_abbrevs_names[$state['option_value']];
        
        $value1 = 0;
        $value2 = 0;

        if($account['tax_return_type'] == 1 || $account['tax_return_type'] == 3){
            $value1 = 1;
            $value2 = 2;
        }
        // if($account['account'] == 4){
        //     $value1 = 0;
        //     $value2 = 9;
        // }

        // if($account['account'] == 3){
            if($tax_type == 1){
                $value1 = 1;
                $value2 = 2;
            }
            if($tax_type == 3){
                $value1 = 0;
                $value2 = 9;
            }
        // }

        $tax_end_path_end  = substr($tax_end,2,2);

        $tax_end_path_start =  substr($tax_end,5);
        $tax_end_path_start = str_replace("-","/", $tax_end_path_start);


        $tax_start_path_end=  substr($tax_start,5);
        $tax_start_path_end = str_replace("-","/", $tax_start_path_end);

        // $tax_start_path_start = str_replace("-","/", $tax_start_path_start);

        $tax_start_path_start = substr($tax_start,0,4);

        $tax_start_full = str_replace("-","/", $tax_end);

        

        $newtime =  date('Y-m-d', time());

        $date = new DateTime($newtime); 
        $date->modify("-1 year");
        $nt =  $date->format("Y-m-d");
        $date = new DateTime($nt);
        
        $testDate = $date->getTimestamp();
        $date = new DateTime($tax_end);
        $testStart = $date->getTimestamp();

        $newcompany = '';
        if($testDate < $testStart ){

            $newcompany = 'True';
        }

        if($tax_start_path_start != '01/01'){
            $newcompany = 'True';
        }
        
        $url = "https://api.pdf.co/v1/pdf/edit/add";
        $parameters = array();

        // $param_url = $this->edit_date_4868(substr($tax_end,0,4));

        // $parameters["url"] = $param_url;
        $parameters["url"] = 'https://ava/public/public/f4868.pdf';

        ///https://www.docfly.com/editor/604c2447013a9054f649/2b07604a37f3113501eb
        // https://app.pdf.co/
        // $parameters["url"] = 'https://ava/public/public/f7004_1.pdf';

        // $data = file_get_contents($parameters["url"]);


      
        // dd($data);
        

        $fields = '[{
            "fieldName": "topmostSubform[0].Page1[0].VoucherHeader[0].f1_1[0]",
            "pages": "0-",
            
            "text": "'.$tax_start_full.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].VoucherHeader[0].f1_2[0]",
            "pages": "0-",
            
            "text": "'.$tax_end_path_start.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].VoucherHeader[0].f1_3[0]",
            "pages": "0-",
            
            "text": "'.$tax_end_path_end.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_4[0]",
            "pages": "0-",
            
            "text": "'.$account_name.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_5[0]",
            "pages": "0-",
            
            "text": "'.$addresses.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_6[0]",
            "pages": "0-",
            
            "text": "'.$city['option_value'].'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_7[0]",
            "pages": "0-",
            
            "text": "'.$state['option_value'].'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_8[0]",
            "pages": "0-",
            
            "text": "'.$zip['option_value'].'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_9[0]",
            "pages": "0-",
            
            "text": "f9"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].Part1_ReadOrder[0].f1_10[0]",
            "pages": "0-",
            
            "text": "f10"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_11[0]",
            "pages": "0-",
            
            "text": "f11"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_12[0]",
            "pages": "0-",
            
            "text": "f12"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_13[0]",
            "pages": "0-",
            
            "text": "f13"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_14[0]",
            "pages": "0-",
            
            "text": "f14"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_15[0]",
            "pages": "0-",
            
            "text": "f15"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_16[0]",
            "pages": "0-",
            
            "text": "f16"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_17[0]",
            "pages": "0-",
            
            "text": "f17"
        },


        {
            "fieldName": "topmostSubform[0].Page1[0].c1_1[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_2[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_3[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[0]",
            "pages": "0-",
            "text": "'.$newcompany.'",
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[1]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[2]",
            "pages": "0-",
            "text": "",
            "value":"1" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[3]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[4]",
            "pages": "0-",
            
            "value":"true" 
        }]';
        
        $fieldsArray = json_decode($fields, true);
        
        $parameters["fields"] = $fieldsArray;

        $data = json_encode($parameters);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($curl);
        $json = json_decode($result, true);

        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                $json = json_decode($result, true);
                $resultFileUrl = $json["url"];

                if ($json["error"] == false && $resultFileUrl){
                    return response()->json(['code' => 200, 'msg' => $resultFileUrl]);
                }
                else{
                    return  $json["message"];
                }
            }
            else{
                return $result ;
            }
        }
        else{
            return curl_error($curl);
        }
        curl_close($curl);

    }


    public function info_reader(){
        $curl = curl_init();
        $url = 'https://api.pdf.co/v1/pdf/info/fields';
        $apiKey = 'testpdf3@ava_c8c96c49a568cd95aadde4da643f9de7176c853329dad2d565dc3c2222922c5231f7966e';
// You can also upload your own file into PDF.co and use it as url. Check "Upload File" samples for code snippets: https://github.com/bytescout/pdf-co-api-samples/tree/master/File%20Upload/    
curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => array('url' => 'https://pdf-temp-files.s3.us-west-2.amazonaws.com/BT3VAS7CXDVQSWHIP8Z0MFQVYIFJRL04/f4868.pdf?X-Amz-Expires=3600&X-Amz-Security-Token=FwoGZXIvYXdzEGQaDNjxe%2FDYpDZsaeLHsCKCAdJxyh4kQedn1ZtuRGiePp68Nm8oq3PqhMiu4vkKoyF9vcCqZsyy5IbbJWLclb1%2FEbPfDxDsvC6hmNTkYDMDhZnRvdZESiTm%2Bz7azhN1ifqVpbgKNGZKDas13gjlKxDL1k2F%2F8jKIOuVM310kfaNPi3UM45PE2jzwymN5IveMy6Pj3QojYu%2BoQYyKLgOAjt9rAasAyC4Ng1s%2F6w0imTY9HPlNncbAVzh4419qU0cH0oWGtA%3D&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIA4NRRSZPHPRXV3W7L/20230407/us-west-2/s3/aws4_request&X-Amz-Date=20230407T071217Z&X-Amz-SignedHeaders=host&X-Amz-Signature=d9141ae23a74d54d7f8a95e93eb3fa5bbd31e27530deb785fe643e53a7d00a7d'),
		CURLOPT_HTTPHEADER => array(
				"x-api-key: $apiKey"
		),
));



$response = json_decode(curl_exec($curl));

curl_close($curl);
echo "<h2>Output:</h2><pre>", var_export($response, true), "</pre>";
    }



    public function pdf_to_json(){
        $apiKey = "testpdf3@ava_c8c96c49a568cd95aadde4da643f9de7176c853329dad2d565dc3c2222922c5231f7966e";

$sourceFileUrl = "https://pdf-temp-files.s3.us-west-2.amazonaws.com/BT3VAS7CXDVQSWHIP8Z0MFQVYIFJRL04/f4868.pdf?X-Amz-Expires=3600&X-Amz-Security-Token=FwoGZXIvYXdzEGQaDNjxe%2FDYpDZsaeLHsCKCAdJxyh4kQedn1ZtuRGiePp68Nm8oq3PqhMiu4vkKoyF9vcCqZsyy5IbbJWLclb1%2FEbPfDxDsvC6hmNTkYDMDhZnRvdZESiTm%2Bz7azhN1ifqVpbgKNGZKDas13gjlKxDL1k2F%2F8jKIOuVM310kfaNPi3UM45PE2jzwymN5IveMy6Pj3QojYu%2BoQYyKLgOAjt9rAasAyC4Ng1s%2F6w0imTY9HPlNncbAVzh4419qU0cH0oWGtA%3D&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIA4NRRSZPHPRXV3W7L/20230407/us-west-2/s3/aws4_request&X-Amz-Date=20230407T071217Z&X-Amz-SignedHeaders=host&X-Amz-Signature=d9141ae23a74d54d7f8a95e93eb3fa5bbd31e27530deb785fe643e53a7d00a7d";

$pages = "";

$password = "";



$url = "https://api.pdf.co/v1/pdf/convert/to/json";


$parameters = array();
$parameters["url"] = $sourceFileUrl;
$parameters["password"] = $password;
$parameters["pages"] = $pages;
$parameters["async"] = true;  


$data = json_encode($parameters);


$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$result = curl_exec($curl);

if (curl_errno($curl) == 0)
{
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    if ($status_code == 200)
    {
        $json = json_decode($result, true);
        
        if (!isset($json["error"]) || $json["error"] == false)
        {
            // URL of generated JSON file that will available after the job completion
            $resultFileUrl = $json["url"];
            // Asynchronous job ID
            $jobId = $json["jobId"];
            
            // Check the job status in a loop
            do
            {
                $status = $this->CheckJobStatus($jobId, $apiKey); // Possible statuses: "working", "failed", "aborted", "success".
                
                // Display timestamp and status (for demo purposes)
                echo "<p>" . date(DATE_RFC2822) . ": " . $status . "</p>";
                
                if ($status == "success")
                {
                    // Display link to the file with conversion results
                    echo "<div><h2>Conversion Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                    break;
                }
                else if ($status == "working")
                {
                    // Pause for a few seconds
                    sleep(3);
                }
                else 
                {
                    echo $status . "<br/>";
                    break;
                }
            }
            while (true);
        }
        else
        {
            // Display service reported error
            echo "<p>Error: " . $json["message"] . "</p>"; 
        }
    }
    else
    {
        // Display request error
        echo "<p>Status code: " . $status_code . "</p>"; 
        echo "<p>" . $result . "</p>"; 
    }
}
else
{
    // Display CURL error
    echo "Error: " . curl_error($curl);
}

// Cleanup
curl_close($curl);
    }



    public function CheckJobStatus($jobId, $apiKey)
    {
        $status = null;
        
        // Create URL
        $url = "https://api.pdf.co/v1/job/check";
        
        // Prepare requests params
        $parameters = array();
        $parameters["jobid"] = $jobId;
    
        // Create Json payload
        $data = json_encode($parameters);
    
        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        // Execute request
        $result = curl_exec($curl);
        
        if (curl_errno($curl) == 0)
        {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200)
            {
                $json = json_decode($result, true);
            
                if (!isset($json["error"]) || $json["error"] == false)
                {
                    $status = $json["status"];
                }
                else
                {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }
            else
            {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>"; 
            }
        }
        else
        {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
        
        // Cleanup
        curl_close($curl);
        
        return $status;
    }



    public function create_pdf(){

        



        $fields =  [
            [
            "fieldName"=> "topmostSubform[0].Page1[0].FilingStatus[0].c1_01[1]",
            "pages"=> "1",
            "text"=> "True"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].f1_02[0]",
            "pages"=> "1",
            "text"=> "John A."
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].f1_03[0]",
            "pages"=> "1",
            "text"=> "Doe"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_04[0]",
            "pages"=> "1",
            "text"=> "123456789"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages"=> "1",
            "text"=> "Joan B."
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages"=> "1",
            "text"=> "Joan B."
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_06[0]",
            "pages"=> "1",
            "text"=> "Doe"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_07[0]",
            "pages"=> "1",
            "text"=> "987654321"
            ]
            
        ];
        
        
        
        // $curl = curl_init();
        
        // curl_setopt_array($curl, array(
        // 		CURLOPT_URL => "https://api.pdf.co/v1/file/upload/get-presigned-url",
        // 		CURLOPT_RETURNTRANSFER => true,
        // 		CURLOPT_ENCODING => "",
        // 		CURLOPT_MAXREDIRS => 10,
        // 		CURLOPT_TIMEOUT => 0,
        // 		CURLOPT_FOLLOWLOCATION => true,
        // 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // 		CURLOPT_CUSTOMREQUEST => "PUT",
        // 		CURLOPT_POSTFIELDS => $fields,
        // 		CURLOPT_HTTPHEADER => array(
        // 				"x-api-key: {{forpdf@ava_ff49ee05a3e0776afcd508acebd1b3c1c9cc47fd5090c0fa2064474a5c74ca2fff7f4c59}}"
        // 		),
        // ));
        
        // $response = curl_exec($curl);
        
        // curl_close($curl);
        // echo $response;
        
        
                // $url = 'https://api.pdf.co/v1/pdf/edit/add';
                // $curl = curl_init();
                // $headers = [
                  
                //     'Content-Type: application/json',
                //     'x-api-key: forpdf@ava_ff49ee05a3e0776afcd508acebd1b3c1c9cc47fd5090c0fa2064474a5c74ca2fff7f4c59' 
                // ];
                
                // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
             
                
                // $fields_string = http_build_query($fields);
        
             
                // curl_setopt($curl, CURLOPT_URL, $url);
                // curl_setopt($curl, CURLOPT_POST, TRUE);
                // curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
                // $data = curl_exec($curl);
        
                // curl_close($curl);
        
        
        
            //     $url = "https://api.pdf.co/v1/file/upload/get-presigned-url" . 
            // "?name=" . "dfdfgdfg" .
            // "&contenttype=application/octet-stream";
            
            //     // Create request
            //     $curl = curl_init();
            //     curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apy_key));
            //     curl_setopt($curl, CURLOPT_URL, $url);
            //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //     // Execute request
            //     $result = curl_exec($curl);
        
        
        
        
        
                
        
                $url = "https://api.pdf.co/v1/pdf/edit/add";
        
        // Prepare requests params
        // See documentation: https://apidocs.pdf.co
        $parameters = array();
        
        // Direct URL of source PDF file.
        $parameters["url"] = "bytescout-com.s3-us-west-2.amazonaws.com/files/demo-files/cloud-api/pdf-form/f1040.pdf";
        
        // Name of resulting file
        $parameters["name"] = "f1040-form-filled";
        
        // If large input document, process in async mode by passing true
        $parameters["async"] = false;
        
        // Field Strings
        $fields =   '[{
            "fieldName": "topmostSubform[0].Page1[0].FilingStatus[0].c1_01[1]",
            "pages": "1",
            "text": "True"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_02[0]",
            "pages": "1",
            "text": "John A."
        },        
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_03[0]",
            "pages": "1",
            "text": "Doe"
        },        
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_04[0]",
            "pages": "1",
            "text": "123456789"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages": "1",
            "text": "Joan B."
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages": "1",
            "text": "Joan B."
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_06[0]",
            "pages": "1",
            "text": "Doe"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_07[0]",
            "pages": "1",
            "text": "987654321"
        }]';// JSON string
        
        // Convert JSON string to Array
        $fieldsArray = json_decode($fields, true);
        
        $parameters["fields"] = $fieldsArray;
        
        // Create Json payload
        $data = json_encode($parameters);
        
        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        // Execute request
        $result = curl_exec($curl);
        
        if (curl_errno($curl) == 0)
        {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200)
            {
                $json = json_decode($result, true);
                
                if ($json["error"] == false)
                {
                    $resultFileUrl = $json["url"];
                    
                    // Display link to the file with conversion results
                    echo "<div><h2>Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                }
                else
                {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }
            else
            {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>";
            }
        }
        else
        {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
        
        // Cleanup
        curl_close($curl);
    }
        
}

