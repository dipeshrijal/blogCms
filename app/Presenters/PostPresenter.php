<?php
namespace blogCms\Presenters;

use Lewis\Presenter\AbstractPresenter;
use League\CommonMark\CommonMarkConverter;

class PostPresenter extends AbstractPresenter
{
    /**
     * PostPresenter constructor.
     * @param object $object
     * @param CommonMarkConverter $markDown
     */
    function __construct($object, CommonMarkConverter $markDown)
    {
        $this->markDown = $markDown;
        
        parent::__construct($object);
    }

    /**
     * @return null|string
     */
    public function excerptHtml()
    {
        return $this->excerpt ? $this->markDown->convertToHtml($this->excerpt) : null;
    }

    /**
     * @return null|string
     */
    public function bodyHtml()
    {
        return $this->body ? $this->markDown->convertToHtml($this->body) : null;
    }

    /**
     * @return string
     */
    public function publishedDate()
    {
        if ($this->published_at) 
        {
            return $this->published_at->toFormattedDateString();
        }
        
        return 'Not Published';
    }

    /**
     * @return string
     */
    public function publishedHighlight()
    {
        if ($this->published_at && $this->published_at->isFuture()) 
        {
            return 'info';
        } 
        elseif (!$this->published_at) 
        {
            return 'warning';
        }
    }
}
