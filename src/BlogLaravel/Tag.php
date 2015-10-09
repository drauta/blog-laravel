<?php
namespace Drauta\BlogLaravel;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = array('name');

     public function posts(){
         return $this->belongsToMany('Drauta\BlogLaravel\Posts');
     }
}
