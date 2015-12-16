<?php

namespace blogCms\Http\Controllers;

use blogCms\Page;

use Illuminate\Http\Request;

use blogCms\Http\Requests;
use blogCms\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page, array $parameters)
    {
        $this->prepareTemplate($page, $parameters);

        return view('page', compact('page'));
    }

    public function prepareTemplate(Page $page,  array $parameters)
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
