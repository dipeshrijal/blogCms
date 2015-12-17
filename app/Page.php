<?php
/*
* Author: Dipesh Rijal
* Date-Created: 2015-12-14
*/
namespace blogCms;

use Baum\Node;

/**
 * Class Page
 * @package blogCms
 */
class Page extends Node
{
	/**
	 * @var array
     */
	protected $fillable = ['title', 'name', 'uri', 'content', 'template', 'hidden'];

	/**
	 * @param $value
     */
	public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value ?: null;
    }

	/**
	 * @param $value
     */
	public function setTemplateAttribute($value)
    {
    	$this->attributes['template'] = $value ?: null;
    }

	/**
	 * @param $order
	 * @param $orderPage
     */
	public function updateOrder($order, $orderPage)
    {
    	$orderPage =  $this->findOrFail($orderPage);

    	if ($order == 'before') {
    		$this->moveToLeftOf($orderPage);
    	}
    	elseif ($order == 'after') {
    		$this->moveToRightOf($orderPage);
    	}
    	elseif ($order == 'childOf') {
    		$this->makeChildOf($orderPage);
    	}
    }
}
