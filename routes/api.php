<?php

Route::apiResource('/questions', 'QuestionController');

Route::apiResource('/categories', 'CategoryController');

Route::apiResource('/questions/{question}/replies', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@like');

Route::post('/dislike/{reply}', 'LikeController@dislike');

Route::post('/notifications', 'NotificationController@index');

Route::post('/notifications/mark-as-read', 'NotificationController@markAsRead');

Route::group([
  'middleware' => 'api',
  'prefix'     => 'auth'
], function ($router) {
  Route::post('login', 'AuthController@login');
  Route::post('signup', 'AuthController@signup');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');
});
