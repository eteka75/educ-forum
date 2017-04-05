<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'forum_post';
    public $timestamps = true;
    protected $fillable = ['forum_discussion_id', 'user_id', 'body', 'markdown'];

    public function discussion()
    {
        return $this->belongsTo(Models::className(Discussion::class), 'forum_discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(config('chatter.user.namespace'));
    }
}
