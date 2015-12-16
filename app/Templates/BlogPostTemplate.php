<?php

namespace blogCms\Templates;

use Illuminate\View\View;
use blogCms\Post;
use Carbon\Carbon;

class BlogPostTemplate extends AbstractTemplate
{
    protected $view = 'blog.post';

    protected $post;

     function __construct(Post $post)
     {
     	$this->post = $post;
     }
    
    public function prepare(View $view, array $parameters) 
    {
    	$post = $this->post->with('author')
                                           ->where('id', $parameters['id'])
                                           ->where('slug', $parameters['slug'])
                                           ->first();

    	$view->with('post', $post);
    }
}
