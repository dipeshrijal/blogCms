<?php
namespace blogCms\Http\Controllers\Backend;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    function __construct() 
    {
        $this->middleware('auth');
    }
}
