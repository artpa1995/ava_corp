<?php

namespace App\Observers;

use App\Model\TaxReturns;

class TaxReturnObserver
{
    /**
     * Handle the TaxReturns "created" event.
     *
     * @param  \App\Model\TaxReturns  $taxReturns
     * @return void
     */
    public function created(TaxReturns $taxReturns)
    {
        //
        
    }

    /**
     * Handle the TaxReturns "updated" event.
     *
     * @param  \App\Model\TaxReturns  $taxReturns
     * @return void
     */
    public function updated(TaxReturns $taxReturns)
    {
        //
        $test[] = $taxReturns->isDirty();
        $test[] = $taxReturns->isDirty('is_published');
        $test[] = $taxReturns->isDirty('user_id');
        $test[] = $taxReturns->getAttribute('is_published');
        $test[] = $taxReturns->is_published;
        $test[] = $taxReturns->getOriginal('is_published');

        return $taxReturns;
    }

    /**
     * Handle the TaxReturns "deleted" event.
     *
     * @param  \App\Model\TaxReturns  $taxReturns
     * @return void
     */
    public function deleted(TaxReturns $taxReturns)
    {
        //
        return $taxReturns;
    }

    /**
     * Handle the TaxReturns "restored" event.
     *
     * @param  \App\Model\TaxReturns  $taxReturns
     * @return void
     */
    public function restored(TaxReturns $taxReturns)
    {
        //
        return $taxReturns;
    }

    /**
     * Handle the TaxReturns "force deleted" event.
     *
     * @param  \App\Model\TaxReturns  $taxReturns
     * @return void
     */
    public function forceDeleted(TaxReturns $taxReturns)
    {
        //
        return $taxReturns;
    }
}
