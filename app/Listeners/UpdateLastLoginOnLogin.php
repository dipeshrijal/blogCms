<?php

namespace blogCms\Listeners;

use Carbon\Carbon;

class UpdateLastLoginOnLogin
{

    /**
     * Handle the event.
     *
     * @param  $user $remember
     * @param $remember
     */
    public function handle($user, $remember)
    {
        $user->last_login_at = Carbon::now();

        $user->save();
    }
}
