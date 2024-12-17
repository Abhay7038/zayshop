<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ClearUserIdSession
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        Session::forget('user_id');
        return Redirect::to('/shop');
    }
}
