<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    // By default, you'll get a table you can reference with "posts"
    // protected $table = 'posts'; //Use this only if 

    // protected $primaryKey = 'id'; // By default - you don't need to use this if you just use id

    protected $fillable = [ //allow mass assignment of data to be inserted into app
        'title',
        'content'
    ];

    protected $dates = ['deleted_at']; //this is already set in the model but this line just brings it up
}
