<?php

namespace blogCms\Presenters;

use Lewis\Presenter\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    /**
     * @return mixed
     */
    public function lastLoginDifference()
    {
        return $this->last_login_at->diffForHumans();
    }
}
