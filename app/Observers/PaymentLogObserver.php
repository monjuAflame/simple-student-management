<?php

namespace App\Observers;

use App\Models\PaymentLog;

class PaymentLogObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(PaymentLog $paymentLog): void
    {
        $paymentLog->created_by = auth()->check() ? auth()->id() : null;
    }
    /**
     * Handle the PaymentLog "created" event.
     */
    public function created(PaymentLog $paymentLog): void
    {
        //
    }

    /**
     * Handle the PaymentLog "updated" event.
     */
    public function updated(PaymentLog $paymentLog): void
    {
        //
    }

    /**
     * Handle the PaymentLog "deleted" event.
     */
    public function deleted(PaymentLog $paymentLog): void
    {
        //
    }

    /**
     * Handle the PaymentLog "restored" event.
     */
    public function restored(PaymentLog $paymentLog): void
    {
        //
    }

    /**
     * Handle the PaymentLog "force deleted" event.
     */
    public function forceDeleted(PaymentLog $paymentLog): void
    {
        //
    }
}
