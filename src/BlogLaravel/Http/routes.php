<?php

// SHOW POSTS


Route::group(['as' => 'blog'], function () {
  get('/', 'BlogController@index'); // Get all posts
  get('category/{id}', 'BlogController@category'); // Get all posts by category
  get('post/{id}', 'BlogController@show'); //View a post
  // CREATE COMMENTS OF POSTS AND COMMENTS
  post('post/{id}', 'ComentarioPostController@comentaPost'); // Create comment about post
  post('comentario/{id}', 'ComentarioPostController@comentaComentario'); // Create comment about comment
});

//Admin Backend
Route::group(['as' => 'admin'], function () {
  get('post', 'CreatePostController@index'); // Form create posts
  post('post/create',  'CreatePostController@create'); // Process create post
  get('post/list',  'CreatePostController@listar'); // List all posts
  get('post/erase/{id}',  'CreatePostController@erasePost');
  get('post/edit/{id}', 'CreatePostController@indexUpdate');
});
