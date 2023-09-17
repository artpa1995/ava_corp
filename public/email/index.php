<?php

error_reporting(E_ALL);
// display_errors(1);


// require_once "/usr/local/cpanel/php/cpanel.php";

// // Print the header
// header('Content-Type: text/plain');

// // Connect to cPanel - only do this once.
// $cpanel = new \CPANEL();

// // Call the API
// $response = $cpanel->uapi(
//     'Email',
//     'add_pop',
//     array (
//         'email' => 'user',
//         'password' => '123456luggage',
//     )
// );

// // Handle the response
// if ($response['cpanelresult']['result']['status']) {
//     $data = $response['cpanelresult']['result']['data'];
//     // Do something with the $data
//     // So you can see the data shape we print it here.
//     print ($data);
// }
// else {
//     // Report errors:
//     print ($response['cpanelresult']['result']['errors']);
// }

// // Disconnect from cPanel - only do this once.
// $cpanel->end();
// die;


include("xmlapi.php");        //XMLAPI cpanel client class

$ip = "64.20.61.228";            // should be server IP address or 127.0.0.1 if local server
$account = "texasrea";        // cpanel user account name
$passwd ="USgV7aBi";          // cpanel user password
$port = 2083;                  // cpanel secure authentication port unsecure port# 2082
$email_domain ="ava";
$email_user ="john";
$email_pass ="johnspassword";
$email_quota = 20;             // 0 is no quota, or set a number in mb

$xmlapi = new xmlapi($ip);
$xmlapi->set_port($port);     //set port number.
$xmlapi->password_auth($account, $passwd);
$xmlapi->set_debug(1);        //output to error file  set to 1 to see error_log.

$call = array('domain' => $email_domain, 'user' => $email_user, 'password' => $email_pass, 'quota' => $email_quota);

$result = $xmlapi->api2_query($account, "Email", "addpop", $call );

print_r($result);            //show the result of your query
die;