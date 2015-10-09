<?php

namespace Drauta\BlogLaravel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Drauta\BlogLaravel\Http\Requests\ComentarioPostRequest;
use Drauta\BlogLaravel\Http\Requests\ResponderComentario;
use Drauta\BlogLaravel\Post;
use Drauta\BlogLaravel\Comment;
use App\User;
use Auth;



class ComentarioPostController extends Controller {

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    public function comentaPost(ComentarioPostRequest $request) {
        $comment1 = new Comment;
        $comment1->name = Auth::user()->name;
        $comment1->email = Auth::user()->email;
        $comment1->textBody = $request->comentario;
        $post = Post::find($request->post_id);
        $comment1->post()->associate($post);
        $comment1->author()->associate(Auth::user());
        $comment1->save();
		return Redirect::to(route('getThePost', ['id'=>$post->id]));
    }

    public function comentaComentario(ResponderComentario $request) {
        $respuesta = new Comment;
        $respuesta->name = Auth::user()->name;
        $respuesta->email = Auth::user()->email;
        $respuesta->textBody = $request->comentario;
        $post = Comment::find($request->quotedComment);
        $respuesta->post()->associate($post);
        $respuesta->quotedComment = $request->quotedComment;
        $post = Post::find($request->post_id);
        $respuesta->post()->associate($post);
        $respuesta->author()->associate(Auth::user());
        $respuesta->save();

        return Redirect::to(route('getThePost', ['id'=>$post->id]));
    }
}
