<?php

namespace App\Listeners;

use App\Events\TaxReturnCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TaxReturnCreated  $event
     * @return void
     */
    public function handle(TaxReturnCreated $event)
    {
        //

        dd($event);
    }
}
