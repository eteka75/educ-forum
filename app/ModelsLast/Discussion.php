<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'forum_discussion';
    public $timestamps = true;
    protected $fillable = ['title', 'forum_category_id', 'user_id', 'slug', 'color'];

    public function user()
    {
        return $this->belongsTo();
    }

    public function category()
    {
        return $this->belongsTo(Models::className(Category::class), 'forum_category_id');
    }

    public function posts()
    {
        return $this->hasMany(Models::className(Post::class), 'forum_discussion_id');
    }

    public function post()
    {
        return $this->hasMany(Models::className(Post::class), 'forum_discussion_id')->orderBy('created_at', 'ASC');
    }

    public function postsCount()
    {
        return $this->posts()
        ->selectRaw('forum_discussion_id, count(*)-1 as total')
        ->groupBy('forum_discussion_id');
    }

    public function users()
    {
        return $this->belongsToMany(config('chatter.user.namespace'), 'forum_user_discussion', 'discussion_id', 'user_id');
    }
}
