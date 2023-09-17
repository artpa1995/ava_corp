<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Webklex\IMAP\Client;
// use Webklex\IMAP\Facades\Client;
// use Keensoen\CPanelApi\CPanel;

use myPHPnotes\cPanel;


class TestEmailController extends Controller
{
    //

    public $plain_msg = '';
    public $html_msg = '';
    public $charset = [];
    public $attachments = [];
    
    public function create_email(){
        
        $cpanel = new CPanel();
        $username = 'p@ava';
        $password = 'ideaHeals@#12';
        $response = $cpanel->createEmailAccount($username, $password);
        
        dd($response);
        
    }
    
    public function connect($hostname, $username, $password) {
    $connection = imap_open($hostname, $username, $password) or die('Cannot connect to Mail: ' . imap_last_error());
    if (!preg_match("/Resource.id.*/", (string) $connection)) {
        return $connection; //return error message
    }
    // $this->imapStream = $connection;
    return true;
    }
    
    public function index(){
         $mailbox = "{ava:993/imap/ssl/novalidate-cert}INBOX";
     $username =  "test1@ava";
    $password =  '-HMqu6Ai_55B'; //"ideaHeals@#12"; //'USgV7aBi';'92923MMLMJ9PHIUHCTR5X970AAN2SWEJ'; //-HMqu6Ai_55B
    $inbox = @imap_open($mailbox, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI')) or die('Cannot connect to email: ' . imap_last_error());
    
     $s = imap_fetchstructure($inbox, 2);
     
     $header = imap_headerinfo($inbox, 2);
     
     $message = imap_fetchbody($inbox, 2, 0);
         $message = imap_body($inbox, 2);
         
         $s = imap_fetchstructure($inbox, 2);
            //  dd($s  );
         
         if (!$s->parts) // Simple message
        {
         getpart($inbox, 2, $s, 0);
        }
        else // Multipart message: cycle through each part
        { 
         foreach ($s->parts as $part_n => $p)
         {
            $this->getpart($inbox, 2, $p, $part_n + 1);
         }
        }
        
    }
    
    public function delete_email(Request $req){
        
        $url = url()->previous();
        $mailbox = "{ava:993/imap/ssl/novalidate-cert}INBOX";
        $username =  $req->input('email_address');
        $password =  '-HMqu6Ai_55B'; //"ideaHeals@#12"; //'USgV7aBi';'92923MMLMJ9PHIUHCTR5X970AAN2SWEJ'; //-HMqu6Ai_55B
        $inbox = @imap_open($mailbox, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI')) or die('Cannot connect to email: ' . imap_last_error());
        
      
      
        $check = imap_mailboxmsginfo($inbox);
        @imap_delete($inbox, $req->input('msg'));
        $check = imap_mailboxmsginfo($inbox);
        if(imap_expunge($inbox)){
            $check = imap_mailboxmsginfo($inbox);
        
            imap_close($inbox);
            return redirect()->to($url)->with('success',  'Message has been delete');
            
        } 
        return redirect()->to($url)->with('danger',  'Message is not delete');

        
    }

 public function emails(){

    $mailbox = "{webhosting2053.is.cc:993/imap/ssl/novalidate-cert}INBOX";
    
    $mailbox = "{ava:993/imap/ssl/novalidate-cert}INBOX";
    
    $username =  "test1@ava";
    $password =  '-HMqu6Ai_55B'; //"ideaHeals@#12"; //'USgV7aBi';'92923MMLMJ9PHIUHCTR5X970AAN2SWEJ'; //-HMqu6Ai_55B
    $mbox = @imap_open($mailbox, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI')) or die('Cannot connect to email: ' . imap_last_error());
    
    $emails = imap_search($mbox,'ALL');
    
    if($emails){
      rsort($emails);
      $email_data = [];
     
     foreach($emails as $msg_number){
         
        $header = imap_headerinfo($mbox, $msg_number);
        $message = imap_body($mbox, $msg_number);
        
        $message = '';
        
        
        if(imap_fetchbody($mbox, $msg_number, 2)){
             $message = imap_fetchbody($mbox, $msg_number, 2);
        }else if(imap_fetchbody($mbox, $msg_number, 1) && empty($message)){
             $message = imap_fetchbody($mbox, $msg_number, 1);
        }
        
        $email_data[] = [
            'msg' => $msg_number,
            'date' => $header->date,
            'subject' => $header->subject,
            'message' => $message,
            'from' => $header->from,
            'to' => $header->toaddress
            ];
     }
    }
    
    return $email_data;
     
 }
 
 public function all_emails(){
     
    //  dd($this->emails());
     
      return view('user.emails.emails', [
            'all_emails' => $this->emails(),
            
        ]);
 }
 
 
 
  public function index3(){
     
     
     
    $emailAddress = 'test1@ava'; // Full email address
    $emailPassword = 'ideaHeals@#12';        // Email password
    $domainURL = 'ava';         // Your websites domain
    $useHTTPS = false;      
    
    $user = 'texasrea'; // defined using define()
    $token = '92923MMLMJ9PHIUHCTR5X970AAN2SWEJ'; // defined using define()
    
    $cpanel_username='texasrea';
    $cpanel_password='USgV7aBi';
         
        //  $cpanel = new CPanel(
        //     $cpanel_domain='ava',
        //     $cpanel_api_token='92923MMLMJ9PHIUHCTR5X970AAN2SWEJ',
        //     $cpanel_username='texasrea',
        //     $cpanel_password='USgV7aBi',
        //     $protocol='https',
        //     $port=2083
        //     );
        
        // $cpanel = new Cpanel();
// $response = $cpanel->getEmailAccounts('john.dansy@texasrealfood.com');

    $cpanel = new cPanel($cpanel_username, 'USgV7aBi', 'webhosting2053.is.cc', $port = 2083, $log = false);
    // https://ava/
    $get_email_username = $cpanel->api2(
        'Email', 'accountname', 
        ['account' => 'test1@ava']
    );
    
    
    
    
    //  $ne = $cpanel->createEmail('test3@ava', 'ideaHeals@#12', 0);
     
     
    //  $mbox = imap_open ("{webhosting2053.is.cc}INBOX", "test1@ava", "ideaHeals@#12");
    
    
    
    $mbox =  imap_open( "{webhosting2053.is.cc:993/novalidate-cert}INBOX" , 'texasrea', '92923MMLMJ9PHIUHCTR5X970AAN2SWEJ') or die(imap_last_error());
    
  $mbox = imap_open("{mail.domain.com:143/novalidate-cert}INBOX", 'login', 'password') or die(imap_last_error());

     
  
   
imap_close ($mbox);
    dd(123);
         

        $parameters = [
            'email' => "test1@ava",
            'password' => "ideaHeals@#12",
            'domain' =>  "ava",
            'quota' => "120" //in MB, 0 for unlimited
        ];      
     
 }

    public function index2(){
        
        $emailAddress = 'test1@ava'; 
        $emailPassword = 'ideaHeals@#12';        
        $domainURL = 'ava';
        $useHTTPS = false; 
        
        $user = 'texasrea'; // defined using define()
        $token = '92923MMLMJ9PHIUHCTR5X970AAN2SWEJ'; // defined using define()
        
            // $query = "https://127.0.0.1:2087/json-api/listaccts?api.version=1"; // works
            $query = 'https://127.0.0.1:2083/execute/Email/get_disk_usage?user='.$emailAddress.'.com&domain='.$domainURL;
        
        
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        
            $header[0] = "Authorization: whm $user:$token";
           
            curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
            curl_setopt($curl, CURLOPT_URL, $query);
        
            $result = curl_exec($curl);
            
            
            echo $result;
            // dd($result);
        
            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
             
            if ($http_status != 200) {
                echo "[!] Error: " . $http_status . " returned\n";
            } else {
                $json = json_decode($result);
                echo "<pre>";
                print_r($json);
                echo "</pre>";
            }
        
            curl_close($curl);
        
        // dd($http_status);
        
        
        
        dd(3454);
        
        
        /* BEGIN MESSAGE COUNT CODE */
        
        $inbox = imap_open('{'.$domainURL.':143/notls}INBOX',$emailAddress,$emailPassword) or die('Cannot connect to domain:' . imap_last_error());
        $oResult = imap_search($inbox, 'UNSEEN');
        
        if(empty($oResult))
            $nMsgCount = 0;
        else
            $nMsgCount = count($oResult);
        
        imap_close($inbox);
        
        echo('<p>You have '.$nMsgCount.' unread messages.</p>');
        
        
        // imap_open("{mail.domain.com:143/novalidate-cert}INBOX", 'login', 'password')

        // $mails = imap_search($stream, 'UNSEEN');
        
        // rsort($mails);
        // foreach ($mails as $mailId) {
        //   imap_fetch_overview($stream, $mailId, 0);
        // }
//         $cpanel = new CPanel();  
// $response = $cpanel->getEmailAccounts();


    // $cpanel = new Cpanel ();
    // $response = $cpanel->getDiskUsage( 'test1@ava' );
dd(122222);
        
        $cpanel = new CPanel(
            $cpanel_domain='ava',
            $cpanel_api_token='92923MMLMJ9PHIUHCTR5X970AAN2SWEJ',
            $cpanel_username='texasrea',
            $protocol='https',
            $port=2083
            );
        
        // $cpanel = new CPanel();  
// $response = $cpanel->getEmailAccounts();


// $cpanel = new Cpanel();
$username = 'test1@ava';
// $password = 'ideaHeals@#12';
// $response = $cpanel->createEmailAccount($username, $password);
$email = $username;
$quota = 1024;
// $response1 = $cpanel->increaseQuota($email,$quota);
$response = $cpanel->getDiskUsage($username);

// $cpanel = new Cpanel();
// $response = $cpanel->deleteEmailAccount('tttt@texasrealfood.com');
dd(45);
//        $username = 'test@dmosk.ru';
//        $password = 'test_test123';
//
//        $mi_conn = $this->mysql_conn();
//        $result = $this->create_mailbox($username, $password);
//
//        echo $result;

//        $this->getemails();

//            $mailbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'example@gmail.com', 'password');
//
//    // This gives an array of message IDs for all messages that are UNSEEN
//            $unseenMessages = imap_search($mailbox, 'UNSEEN');
//
//    // Keep in mind that imap_search returns false, if it doesn't find anything
//            $unseenCount = !$unseenMessages ? 0 : count($unseenMessages);
//            echo "$unseenCount New Emails!\n";
//
//            if ($unseenMessages) {
//                // The second parameter of imap_setflag_full function is a comma separated string of message IDs
//                // It can also be a range eg 1:5, which would be the same as 1,2,3,4,5
//                imap_setflag_full($mailbox, implode(',', $unseenMessages), '\Seen');
//            }


        // $oClient = new Client([
        //     'host'          => 'imap.gmail.com',
        //     'port'          => 993,
        //     'encryption'    => 'ssl',
        //     'validate_cert' => true,
        //     'username'      => 'ParuyrKirakosyan160695@gmail.com',
        //     'password'      => 'artpa123698745',
        //     'protocol'      => 'imap'
        // ]);

    

        $url = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
        $id = "tutorialspoint.testsdcsdcsdcd@gmail.com";
        $pwd = "cohondob_123";
        $mailbox = imap_open($url, $id, $pwd);
        print("Connection established....");
        print("<br>");

        //Creating a mailbox
        $newmailbox = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX.new_mail_box";
        $res = imap_createmailbox($mailbox, imap_utf7_encode($newmailbox));
        
        if($res){
           print("Mailbox created successfully");
        } else {
           print("Error occurred");
        }

     die;


        $oClient = Client::account('gmail');
     
        $oClient->connect();
        $oFolder = $oClient->getFolder('INBOX.read'); 

        $aMessage = $oFolder->query()->all()->get();

           echo "<pre>";
         print_r($aMessage);
    }



    public function getpart($mbox, $mid, $p, $part_n){
        $data = ($part_n) ? imap_fetchbody($mbox, $mid, $part_n) : imap_body($mbox, $mid);
         
        if ($p->encoding == 4) {
            $data = quoted_printable_decode($data);
        }
        else if ($p->encoding == 3){
            $data = base64_decode($data);
        }
         
        $eparams = array();
        if ($p->parameters){
            foreach ($p->parameters as $x){
                $eparams[strtolower($x->attribute)] = $x->value;
            }
        }
      
         
        if (!empty($p->dparameters)){
            foreach ($p->dparameters as $x){
                $eparams[strtolower($x->attribute)] = $x->value;
            }
        }
         
        if (!empty($eparams['filename']) || !empty($eparams['name'])) {
            $filename = ($eparams['filename']) ? $eparams['filename'] : $eparams['name'];
            $this->attachments[$filename] = $data;
        }
           
         
        if ($p->type == 0 && $data){
            if (strtolower($p->subtype) == 'plain'){
                $this->plain_msg .= trim($data) ."\n\n";
            }else{
                $this->html_msg .= $data . '<br><br>';
             }
             $this->charset = $eparams['charset'];
         }
         else if ($p->type == 2 && $data) {
            $this->plain_msg .= $data. "\n\n";
         }
         
         if (!empty($p->parts)) {
             foreach ($p->parts as $part_n2 => $p2){
                self::getpart($mbox, $mid, $p2, $part_n . '.' . ($part_n2 + 1));
             }
         }
    }



}
