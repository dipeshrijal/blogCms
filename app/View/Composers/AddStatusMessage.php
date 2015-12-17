<?php

/*
 * Author: Dipesh Rijal
 * Date-Created: 2015-12-10
*/

namespace blogCms\View\Composers;

use Illuminate\View\View;

class AddStatusMessage
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('status', session('status'));
    }
}
