<?php

Route::apiResource('/questions', 'QuestionController');

Route::apiResource('/categories', 'CategoryController');

Route::apiResource('/questions/{question}/replies', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@like');

Route::delete('/dislike/{reply}', 'LikeController@dislike');
