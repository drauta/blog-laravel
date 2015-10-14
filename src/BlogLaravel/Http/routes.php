<?php

// SHOW POSTS


Route::group(['prefix' => 'blog'], function () {
  get('/', 'BlogController@index'); // Get all posts
  get('category/{id}', 'BlogController@category'); // Get all posts by category
  get('post/{id}', 'BlogController@show'); //View a post

  post('post/{id}', 'ComentariController@comentaPost'); // Create comment about post
  post('comentario/{id}', 'ComentarioController@comentaComentario'); // Create comment about comment
});

//Admin Backend
Route::group(['prefix' => 'admin'], function () {
  Route::resource('post', 'PostController');
});
