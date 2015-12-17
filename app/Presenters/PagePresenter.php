<?php

namespace blogCms\Presenters;

use Lewis\Presenter\AbstractPresenter;
use League\CommonMark\CommonMarkConverter;

class PagePresenter extends AbstractPresenter
{
    protected $markDown;

    /**
     * PagePresenter constructor.
     * @param object $object
     * @param CommonMarkConverter $markDown
     */
    function __construct($object, CommonMarkConverter $markDown)
    {
        $this->markDown = $markDown;

        parent::__construct($object);
    }

    /**
     * @return string
     */
    public function contentHtml()
    {
        return $this->markDown->convertToHtml($this->content);
    }

    /**
     * @return string
     */
    public function uriWildCard()
    {
        return $this->uri . '*';
    }

    /**
     * @return string
     */
    public function prettyUri()
    {
        return '/' . ltrim($this->uri, '/');
    }

    /**
     * @param $link
     * @return string
     */
    public function linkToPadedTitle($link)
    {
        $padding = str_repeat('&nbsp', $this->depth * 4);
        
        return $padding . link_to($link, $this->title);
    }

    /**
     * @return string
     */
    public function padedTitle()
    {
        return str_repeat('&nbsp;', $this->depth * 4) . $this->title;
    }
}
