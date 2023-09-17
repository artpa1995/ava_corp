<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyCreated;
use App\Events\ChangeCompanyStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;


class SendEmailChangeCompany implements ShouldQueue
 {
    /**
     * Create the event listener.
     *
     * @return void
     */

    use InteractsWithQueue;
    
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ChangeCompanyStatus $event)
    {
        $this->executeCommand($event);
    }

    public function executeCommand($event){
        $event;

        Artisan::call('quote:daily', [
            '--data' => json_encode(['data' => $event->company]),
        ]);

    }
}
