<?php

// SHOW POSTS
Route::get('blog', ['as' => 'allPosts', 'uses' => 'BlogController@index']); // Get all posts
Route::get('blog/category/{id}', ['as' => 'postByCategory', 'uses' => 'BlogController@category']); // Get all posts by category
Route::get('blog/post/{id}', ['as' => 'getThePost', 'uses' => 'BlogController@post']); //View a post
// CREATE COMMENTS OF POSTS AND COMMENTS
Route::post('blog/post/{id}', ['as' => 'createComent', 'uses' => 'ComentarioPostController@comentaPost']); // Create comment about post
Route::post('blog/comentario/{id}', ['as' => 'createComentComent', 'uses' => 'ComentarioPostController@comentaComentario']); // Create comment about comment
// ADMIN POSTS
Route::get('admin/post', ['as' => 'formAdminPosts', 'uses' => 'CreatePostController@index']); // Form create posts
Route::post('admin/post/create', ['as' => 'createPostProces', 'uses' => 'CreatePostController@create']); // Process create post
Route::get('admin/post/list', ['as' => 'formListPosts', 'uses' => 'CreatePostController@listar']); // List all posts
Route::get('admin/post/erase/{id}', ['as' => 'formErasePost', 'uses' => 'CreatePostController@erasePost']);
Route::get('admin/post/edit/{id}', ['as' => 'formEditPost', 'uses' => 'CreatePostController@indexUpdate']);





// CARGAR DATOS DE PRUEBA
Route::get('test', 'BlogController@test');
