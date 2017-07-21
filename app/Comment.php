<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $guarded = ["id"];

    public function story()
    {
        return $this->belongsTo('App\Story');
    }
}
