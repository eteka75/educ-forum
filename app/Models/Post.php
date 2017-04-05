<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Discussion;
use App\User;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_posts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['discussion_id', 'user_id', 'body', 'markdown', 'locked'];

     public function discussion()
    {
        return $this->belongsTo('App\Models\Discussion', 'discussion_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
