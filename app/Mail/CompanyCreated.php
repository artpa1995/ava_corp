<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;

class CompanyCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->html($this->mailData['body'])
        ->subject($this->mailData['subject']);

        // return  $this->view('emails.company_created', ['body' => $this->mailData['body']])
        //             ->with(['body' => $this->mailData['body']])
        //             ->subject($this->mailData['subject']);
    }
}
