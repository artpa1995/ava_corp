<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyCreated;

class UpdateCompanyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email_data;

    public function __construct(array $data)
    {
        //
        $this->email_data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $data = $this->email_data;
        foreach($data['emails'] as $email){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::to(trim($email))
                ->bcc('poterop744@larland.com')
                ->queue(new CompanyCreated($data));
            }
        }
    }
}
