<?php

namespace App\Listeners;

use App\Events\ConfirmUser;

class ChangeUserConfirmSig
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
     * @param ConfirmUser $event
     *
     * @return void
     */
    public function handle(ConfirmUser $event)
    {
        $user = \Auth::user()->update(['confirmed' => 1]);

        return $user;
    }
}
