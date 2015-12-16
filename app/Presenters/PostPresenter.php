<?php
namespace blogCms\Presenters;

use Lewis\Presenter\AbstractPresenter;
use League\CommonMark\CommonMarkConverter;

class PostPresenter extends AbstractPresenter
{
    function __construct($object, CommonMarkConverter $markDown) 
    {
        $this->markDown = $markDown;
        
        parent::__construct($object);
    }

    public function excerptHtml()
    {
        return $this->excerpt ? $this->markDown->convertToHtml($this->excerpt) : null;
    }

    public function bodyHtml()
    {
        return $this->body ? $this->markDown->convertToHtml($this->body) : null;
    }
    
    public function publishedDate() 
    {
        if ($this->published_at) 
        {
            return $this->published_at->toFormattedDateString();
        }
        
        return 'Not Published';
    }
    
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
