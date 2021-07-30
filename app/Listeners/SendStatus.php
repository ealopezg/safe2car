<?php

namespace App\Listeners;

use App\Events\StatusSended;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStatus
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
     * @param  StatusSended  $event
     * @return void
     */
    public function handle(StatusSended $event)
    {
        //
    }
}
