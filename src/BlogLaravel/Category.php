<?php
namespace Drauta\BlogLaravel;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name');

    public function posts(){
        return $this->belongsToMany('Drauta\BlogLaravel\Post','categorys_posts');
    }
}
