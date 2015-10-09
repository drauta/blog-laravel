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
	private $numPorPagina = 10;

	// List of posts

	public function __construct (){

	}

    public function index()
    {
        $categorias = Category::all();
        $posts = Post::where('borrador',false)->orderby("fechaPublicar","desc")->paginate($this->numPorPagina);
        return view('blogLaravel::front.blog', ['categorias' => $categorias, 'posts' => $posts]);

    }

	// See the post
	public function post($id) {
        return view('blogLaravel::front.post', ['post' => Post::findOrFail($id), 'categorias'=>$categorias = Category::all()]);
    }
	// List of posts by category
	public function category($id) {
        // RECUPERAR DATOS
        $categorias = Category::all();
        $categoria = Category::find($id);
        // POSTS DE LA CATEGORIA PAGINADOS
        $posts = $categoria->posts()->where('borrador',false)->paginate($this->numPorPagina);
        return view('blogLaravel::front.blog', ['categorias' => $categorias, 'posts' => $posts]);
    }
   	
}
