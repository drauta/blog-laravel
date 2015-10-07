<?php
namespace BlogLaravel\Http\Controllers;

use App\User;
use BlogLaravel\Post;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{

    public function index()
    {
        return view('post.home', ['posts' => Post::paginate(15)]);
    }
}
