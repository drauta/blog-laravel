<?php

// SHOW POSTS


Route::group(['as' => 'blog'], function () {
  get('/', 'BlogController@index'); // Get all posts
  get('category/{id}', 'BlogController@category'); // Get all posts by category
  get('post/{id}', 'BlogController@show'); //View a post
  // CREATE COMMENTS OF POSTS AND COMMENTS
  post('post/{id}', 'ComentariController@comentaPost'); // Create comment about post
  post('comentario/{id}', 'ComentarioController@comentaComentario'); // Create comment about comment
});

//Admin Backend
Route::group(['as' => 'admin'], function () {
  Route::resource('post', 'PostController');


});
