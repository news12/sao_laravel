<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventSubscriber
{
    public function onUserLogin($event)
    {
        $tokenAccess = bcrypt(date('YmdHms'));

        $user = auth()->user();
        $user->token_access = $tokenAccess;
        $user->save();

        session()->put('access_token', $tokenAccess);
    }

    /**
     * Register the listeners for the subscriber.
     *

     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );


     /*   $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );*/

    }
}
