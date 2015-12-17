<?php

namespace blogCms\Http\Controllers;

use blogCms\Http\Requests;
use blogCms\Page;

/**
 * Class PageController
 * @package blogCms\Http\Controllers
 */
class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @param array $parameters
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Page $page, array $parameters)
    {
        $this->prepareTemplate($page, $parameters);

        return view('page', compact('page'));
    }

    /**
     * @param Page $page
     * @param array $parameters
     */
    public function prepareTemplate(Page $page, array $parameters)
    {
        $templates = config('cms.templates');

        if (! $page->template || ! isset($templates[$page->template])) {
            return ;
        }

        $template = app($templates[$page->template]);

        $view = sprintf('templates.%s', $template->getView());

        if (! view()->exists($view)) {
            return;
        }

        $template->prepare($view = view($view), $parameters);

        $page->view = $view;
    }
    
}
