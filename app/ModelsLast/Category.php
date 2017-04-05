<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'forum_categories';
    public $timestamps = true;

    public function discussions()
    {
        return $this->hasMany(Models::className(Discussion::class));
    }
}
