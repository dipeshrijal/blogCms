<?php

namespace blogCms\View\Composers;

use blogCms\Page;
use Illuminate\View\View;

class InjectPages
{
    protected $page;

    /**
     * InjectPages constructor.
     * @param Page $page
     */
    function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
    	$pages = $this->page->where('hidden', 'false')->get()->toHierarchy();

    	$view->with('pages', $pages);
    }
}
