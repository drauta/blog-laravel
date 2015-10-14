<?php
namespace Drauta\BlogLaravel\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Drauta\BlogLaravel\Post;
use Drauta\BlogLaravel\Tag;
use Drauta\BlogLaravel\Category;
use Drauta\BlogLaravel\Comment;
use Drauta\BlogLaravel\Archivo;

class BlogController extends Controller
{


	public function __construct (){

	}
    public function index()
    {
        $categorias = Category::all();
        $posts = Post::where('borrador',false)->orderby("fechaPublicar","desc")->paginate(10);
				return view('blogLaravel::front.blog', ['categorias' => $categorias, 'posts' => $posts]);

    }

	// See the post
	public function show($id) {
        return view('blogLaravel::front.post', ['post' => Post::findOrFail($id), 'categorias'=>$categorias = Category::all()]);
    }
	// List of posts by category
	public function category($id) {
        $categorias = Category::all();
        $categoria = Category::find($id);
        $posts = $categoria->posts()->where('borrador',false)->paginate($this->numPorPagina);
        return view('blogLaravel::front.blog', ['categorias' => $categorias, 'posts' => $posts]);
    }

}
