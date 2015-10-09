<?php

namespace Drauta\BlogLaravel\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Drauta\BlogLaravel\Http\Requests\PostFormRequest;
use App\User;
use Drauta\BlogLaravel\Post;
use Drauta\BlogLaravel\Tag;
use Drauta\BlogLaravel\Category;
use Drauta\BlogLaravel\Comment;
use Auth;

class CreatePostController extends \App\Http\Controllers\Controller {

    public function index() {
        $categorias = Category::all();
        //$tags = Tag::all();
        $tags = array();
        return view('blogLaravel::admin.formPost', ['categorias' => $categorias, 'tags' => $tags, 'tipo' => 'crear']);
    }

    public function indexUpdate($id) {
        // OBTENER POST
        $post = Post::find($id);
        $categoria = $post->categorys()->first();
        $categorias = Category::all();
        $tags = $post->tags()->get();
        return view('blogLaravel::admin.formPost', ['categorias' => $categorias, 'tags' => $tags, 'post' => $post, 'categoriaActual' => $categoria->id, 'tipo' => 'actualizar', 'idPost' => $id]);
    }

    public function create(PostFormRequest $request) {
        $tipoLlamada = $request->tipo; // CREAR O UPDATE
        $idPost = trim($request->idPost); // 0 SI NO EXISTE --> CREAR UNO NUEVO // SI ES DIFERENTE A 0 SI QUE EXISTE --> ACTUALIZAR
        $cambiarFichero = true;
        // RECOPILAR VARIABLES
        //no cal


        $titulo = $request->titulo;
        $cuerpo = $request->contenido;
        $descripcion = $request->descripcion;
        $descripcion = $request->descripcion;
        $borrador = $request->borrador;
        $file = $request->file("file");
        $categoria = $request->categoria;

        $author = Auth::user()->id;
        $tags = explode(",", $request->tags);
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {

               //Mirar mimetype
                $nombre = str_random(40).$request->('file')>guessClientExtension(); //NOMBRE FICHERO
                $destinationPath = public_path().'/vendor/bloglaravel/imgposts/imagenes';

                $request->file('file')->move($destinationPath, $nombre);
            }
        } else {
            $cambiarFichero = false;
        }

        if (true) { //BLOQUEADA LA CREACI�N DE POST
            $rutaImagen = "";
            if ($nombre != "") {
                $rutaImagen = substr($this->rutaImagenesPost . "/" . $nombre, strlen(public_path()));
            }
            $this->generarPost($titulo, $cuerpo, $author, $destinationPath, $tags, $categoria, $descripcion, $borrador, $idPost, $cambiarFichero);
        }

        return redirect()->action("\Drauta\BlogLaravel\Http\Controllers\CreatePostController@listar");
    }

    public function listar() {
        $posts = Post::orderBy("fechaPublicar", "desc")->paginate(10);
        return view('blogLaravel::admin.listPosts', ['posts' => $posts]);
    }

    public function erasePost($id) {
        $post = Post::find($id);
        $post->delete();
        //Pasar a ajax
        return redirect()->back();
    }


    //Esto es muy feo
    public function generarPost($titulo, $cuerpo, $author, $imagen, $tags, $categoria, $descripcion, $borrador, $idPost, $cambiarFichero) {
        $borradorInicial = "";
        if ($idPost == 0) {
            $post = new Post;
        } else {
            $post = Post::find($idPost);
            $borradorInicial = $post->borrador;
        }
        $post->title = $titulo;
        $post->textBody = $cuerpo;
        if ($cambiarFichero) {
            if (file_exists($post->image)) {
                unlink($post->image);
            }
            $post->image = $imagen;
        }
        $post->author_id = $author;
        $post->descripcion = $descripcion;
        if ($borrador == "false") {
            $post->borrador = false;
        } else {
            $post->borrador = true;
        }

        $post->save();

        if ($borradorInicial != "") { //POST EDITAR
            if ($borradorInicial && $borrador == "false") {
                $post->fechaPublicar = $post->updated_at;
                $post->save();
            } else {
                $post->fechaPublicar = $post->created_at;
            }
        } else { // POST CREAR
            $post->fechaPublicar = $post->created_at;
            $post->save();
        }

        $post->save();
        $post->tags()->detach();
        foreach ($tags as $nameTag) {
            $tag = Tag::where("name", $nameTag)->first();
            if ($tag == null) {
                $tag = new Tag();
                $tag->name = $nameTag;
                $tag->save();
            }
            $post->tags()->attach($tag->id);
        }
        $post->categorys()->detach();
        $post->categorys()->attach($categoria);
    }

}

?>
