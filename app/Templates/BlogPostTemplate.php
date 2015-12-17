<?php

namespace blogCms\Templates;

use Illuminate\View\View;
use blogCms\Post;
use Carbon\Carbon;

class BlogPostTemplate extends AbstractTemplate
{
    protected $view = 'blog.post';

    protected $post;

    /**
     * BlogPostTemplate constructor.
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
    	$post = $this->post->with('author')
                            ->where('id', $parameters['id'])
                            ->where('slug', $parameters['slug'])
                            ->first();

    	$view->with('post', $post);
    }
}
