<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_categories';

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
//    protected $fillable = ['user_id', 'parent_id', 'order', 'name', 'logo', 'color', 'resume', 'description', 'slug'];
    protected $fillable = ['user_id', 'domaine_id', 'image', 'order', 'name', 'color', 'slug', 'description'];

    public function discussions() {
        return $this->hasMany('App\Models\Discussion', "categorie_id");
    }

    public function counts() {
//        return $this
//        ->selectRaw('discussion_id, count(*)-1 as total')
//        ->groupBy('discussion_id');
    }

}
