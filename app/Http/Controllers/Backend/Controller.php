<?php
namespace blogCms\Http\Controllers\Backend;

use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package blogCms\Http\Controllers\Backend
 */
abstract class Controller extends BaseController
{
    /**
     * Controller constructor.
     */
    function __construct()
    {
        $this->middleware('auth');
    }
}
