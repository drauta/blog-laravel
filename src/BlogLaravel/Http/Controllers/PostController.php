<?php

namespace Drauta\BlogLaravel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Drauta\BlogLaravel\Http\Requests\PostFormRequest;
use App\User;
use Drauta\BlogLaravel\Post;
use Drauta\BlogLaravel\Tag;
use Drauta\BlogLaravel\Category;
use Drauta\BlogLaravel\Comment;
use Auth;

class PostController extends Controller {

    public function index() {
      $posts = Post::orderBy("fechaPublicar", "desc")->paginate(10);
      return view('blogLaravel::admin.listPosts', ['posts' => $posts]);
    }

    public function create() {
      return view('blogLaravel::admin.listPosts');
    }



    public function store(PostFormRequest $request){
      $post = new Post($request);
      $post->save();
    }

    public function edit($id){
      $post = Post::find($id);
      return view('blogLaravel::admin.editPosts');
    }


    public function update(PostFormRequest $request) {
      $post = Post::find($id);
      $post->fill($request);
      $post->save();
    }

    public function destroy($id) {
        $post = Post::find($id);
        $post->delete();
    }


}

?>
