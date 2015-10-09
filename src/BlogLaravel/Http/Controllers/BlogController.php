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
   	
	
	
	
	
	///////******************************************///////
	
	public function test (){
		
		$user = new \App\User;
        $user->name = 'Admin';
        $user->email = 'sb@drauta.com';
        $user->password = \Hash::make('123456');
        $user->save();
        
        $user->save();
        $user = new \App\User;
        $user->name = 'Santi';
        $user->email = 'sl@drauta.com';
        $user->password = \Hash::make('123456');
        $user->save();

        $user = new \App\User;
        $user->name = 'Yo';
        $user->email = 'ss@drauta.com';
        $user->password = \Hash::make('654321');
        $user->save();

        $this->crearCategorias();
        $this->crearTags();
        $this->crearPosts();
        $this->crearComentarios();   
		
	}
	
	 public function crearComentarios() {
        $comment1 = new Comment;
        $comment1->name = "Hola soy un comentario";
        $comment1->email = "dsad@gmail.com";
        $comment1->textBody = "Este es el cuerpo del comentario";
        $post = Post::find(1);
        $comment1->post()->associate($post);
        $comment1->save();
    }

    public function crearPosts() {
        $post1 = new Post;
        $post1->title = "A CLOCKWORK ORIGIN";
        $post1->textBody = "And from now on you're all named Bender Jr. The alien mothership is in orbit here. If we can hit that bullseye, the rest of the dominoes will fall like a house of cards. Checkmate. Now that the, uh, garbage ball is in space, Doctor, perh...";
        $post1->image = "/assets/img/tmp/product-3.jpg";
        $post1->author_id = 1;
        $post1->borrador = true;
        $post1->save();
        $post1->fechaPublicar = $post1->created_at;
        $post1->save();
        
        $post1->tags()->attach(1);
        $post1->tags()->attach(2);

        $post1->categorys()->attach(1);


        $post2 = new Post;
        $post2->title = "WHERE NO FAN HAS GONE BEFORE";
        $post2->textBody = "Just once I'd like to eat dinner with a celebrity who isn't bound and gagged. The alien mothership is in orbit here. If we can hit that bullseye, the rest of the dominoes will fall like a house of cards. Checkmate. Ho...";
        $post2->image = "/assets/img/tmp/product-2.jpg";
        $post2->author_id = 1;
        $post2->borrador = false;
        $post2->save();
        $post2->fechaPublicar = $post2->created_at;
        $post2->save();
        $post2->tags()->attach(1);

        $post2->categorys()->attach(3);

        $post3 = new Post;
        $post3->title = "WHERE NO FAN HAS GONE BEFORE";
        $post3->textBody = "Just once I'd like to eat dinner with a celebrity who isn't bound and gagged. The alien mothership is in orbit here. If we can hit that bullseye, the rest of the dominoes will fall like a house of cards. Checkmate. Ho...";
        $post3->image = "/assets/img/tmp/product-2.jpg";
        $post3->author_id = 1;
        $post3->borrador = false;
        $post3->save();
        $post3->fechaPublicar = $post3->created_at;
        $post3->save();

        $post3->tags()->attach(2);

        $post3->categorys()->attach(4);
    }

    public function crearCategorias() {
        $cat = new Category();
        $cat->name = "Automotive";
        $cat->save();

        $cat = new Category();
        $cat->name = "Jobs";
        $cat->save();

        $cat = new Category();
        $cat->name = "Nightlife";
        $cat->save();

        $cat = new Category();
        $cat->name = "Services";
        $cat->save();

        $cat = new Category();
        $cat->name = "Transportation";
        $cat->save();

        $cat = new Category();
        $cat->name = "Real Estate";
        $cat->save();

        $cat = new Category();
        $cat->name = "Restaurants";
        $cat->save();
    }

    public function crearTags() {
        $tag1 = new Tag();
        $tag1->name = "Tag1";
        $tag1->save();

        $tag2 = new Tag();
        $tag2->name = "Tag4";
        $tag2->save();

        $tag3 = new Tag();
        $tag3->name = "Tag4";
        $tag3->save();

        $tag4 = new Tag();
        $tag4->name = "Tag4";
        $tag4->save();
    }
	
	///////******************************************///////
}
