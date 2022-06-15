<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = true;
        
    /**
     * relation to comments
     *
     * @return void
     */
    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }
    
    /**
     * relation to tags
     *
     * @return void
     */
    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }
    
    /**
     * relation to categories
     *
     * @return void
     */
    public function categories()
    {
    	return $this->belongsTo('App\Category');
    }
    
    /**
     * check hasImage
     *
     * @return bool
     */
    public function hasImage(): bool
    {
        return filled($this->image_file_name);
    }
}