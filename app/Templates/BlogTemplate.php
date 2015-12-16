<?php

namespace blogCms\Templates;

use Illuminate\View\View;
use blogCms\Post;
use Carbon\Carbon;

class BlogTemplate extends AbstractTemplate
{
    protected $view = 'blog';

    protected $post;

     function __construct(Post $post)
     {
     	$this->post = $post;
     }
    
    public function prepare(View $view, array $parameters) 
    {
    	$posts = $this->post->with('author')
                                           ->where('published_at', '<', Carbon::now())
                                           ->orderBy('published_at', 'desc')
                                           ->paginate(10);

    	$view->with('posts', $posts);
    }
}
