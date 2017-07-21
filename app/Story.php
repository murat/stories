<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = "stories";
    protected $guarded = ["id"];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Set the story title
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
