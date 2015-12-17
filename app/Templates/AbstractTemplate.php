<?php

namespace blogCms\Templates;

use Illuminate\View\View;

abstract class AbstractTemplate
{
    protected $view;

    /**
     * @param View $view
     * @param array $parameters
     * @return mixed
     */
    abstract public function prepare(View $view, array $parameters);

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }
}
