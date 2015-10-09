<?php
namespace Drauta\BlogLaravel;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'textBody', 'image','borrador','fechaPublicar','descripcion'];

    public function author() {
        return $this->belongsTo('App\User');
    }
    
    public function tags()
    {
        return $this->belongsToMany('Drauta\BlogLaravel\Tag');
    }
    public function categorys()
    {
        return $this->belongsToMany('Drauta\BlogLaravel\Category','categorys_posts');
    }
    public function comments()
    {
        return $this->hasMany('Drauta\BlogLaravel\Comment');
    }   
    
}