<?php

namespace blogCms\Presenters;

use Lewis\Presenter\AbstractPresenter;
use League\CommonMark\CommonMarkConverter;

class PagePresenter extends AbstractPresenter
{
    protected $markDown;

    function __construct($object, CommonMarkConverter $markDown)
    {
        $this->markDown = $markDown;

        parent::__construct($object);
    }

    public function contentHtml()
    {
        return $this->markDown->convertToHtml($this->content);
    }

    public function uriWildCard()
    {
        return $this->uri . '*';
    }

    public function prettyUri() 
    {
        return '/' . ltrim($this->uri, '/');
    }
    
    public function linkToPadedTitle($link) 
    {
        $padding = str_repeat('&nbsp', $this->depth * 4);
        
        return $padding . link_to($link, $this->title);
    }
    
    public function padedTitle() 
    {
        return str_repeat('&nbsp;', $this->depth * 4) . $this->title;
    }
}
