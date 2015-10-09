<?php

namespace Drauta\BlogLaravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = array('name','email','textBody');

     protected $rules = array(
         'comentario' => 'required',
         'nombre' => 'required',
         'email' => 'required|email',
         'web' => 'url'
     );

     protected $errors;

     public function post(){
         return $this->belongsTo('Drauta\BlogLaravel\Post');
     }

     public function author(){
         return $this->belongsTo('App\User', 'author_id');
     }

     public function quote(){
         return $this->belongsTo('Drauta\BlogLaravel\Comment','quotedComment','id');
     }

     public function quotedBy(){
         return $this->hasMany('Drauta\BlogLaravel\Comment','quotedComment','id');
     }

     public function validate($data){
         // make a new validator object
         $v = Validator::make($data, $this->rules);

         // check for failure
         if ($v->fails()){
             // set errors and return false
             $this->errors = $v->errors;
             return false;
         }
         // validation pass
         return true;
     }
     public function errors(){
         return $this->errors;
     }

}
