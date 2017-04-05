<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_discussions';

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
    protected $fillable = ['categorie_id', 'user_id', 'parent_id', 'title', 'sticky', 'views', 'answered', 'slug', 'color'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'forum_user_discussion', 'discussion_id', 'user_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categorie_id');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'discussion_id');
    }
    public function post()
    {
        return $this->hasMany('App\Models\Post', 'discussion_id')->orderBy('created_at', 'ASC');
    }
    public function postsCount()
    {
        return $this->posts()
        ->selectRaw('discussion_id, count(*)-1 as total')
        ->groupBy('discussion_id');
    }

}
