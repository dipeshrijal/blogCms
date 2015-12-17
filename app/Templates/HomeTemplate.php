<?php

namespace blogCms\Templates;

use Illuminate\View\View;
use blogCms\Post;
use Carbon\Carbon;

class HomeTemplate extends AbstractTemplate
{
    protected $view = 'home';

    protected $post;

    /**
     * HomeTemplate constructor.
     * @param Post $post
     */
    function __construct(Post $post)
     {
     	$this->post = $post;
     }

    /**
     * @param View $view
     * @param array $parameters
     * @return mixed|void
     */
    public function prepare(View $view, array $parameters)
    {
    	$posts = $this->post->with('author')->where('published_at', '<', Carbon::now())->orderBy('published_at', 'desc')->take(3)->get();
    	$view->with('posts', $posts);
    }
}
