<?php

namespace blogCms;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package blogCms
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'slug', 'body', 'excerpt', 'published_at'];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @param $value
     */
    public function setPublishedAtAttributes($value)
    {
    	$this->attributes['published_at'] = $value ?: null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
    	return $this->belongsTo(User::class);
    }
}
