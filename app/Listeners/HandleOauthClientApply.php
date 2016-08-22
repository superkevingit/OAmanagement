<?php

namespace App\Listeners;

use App\Events\OauthClientApply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOauthClientApply
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
     * @param  OauthClientApply  $event
     * @return void
     */
    public function handle(OauthClientApply $event)
    {
        //
    }
}
