<?php

namespace blogCms\Listeners;

use Carbon\Carbon;

class UpdateLastLoginOnLogin
{

    /**
     * Handle the event.
     *
     * @param  $user  $remember
     * @return void
     */
    public function handle($user, $remember)
    {
        $user->last_login_at = Carbon::now();

        $user->save();
    }
}
