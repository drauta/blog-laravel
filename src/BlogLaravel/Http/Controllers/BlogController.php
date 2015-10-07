<?php
namespace Drauta\BlogLaravel\Http\Controllers;

use App\User;
use Drauta\BlogLaravel\Post;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{

    public function index()
    {
        return view('post.home', ['posts' => Post::paginate(15)]);
    }
}
