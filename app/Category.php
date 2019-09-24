<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['parent_id','name','description','status'];

    public function categories(){
        return $this->hasMany('App\Category','parent_id');
    }
    
}
