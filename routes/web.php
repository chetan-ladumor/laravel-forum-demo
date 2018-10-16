<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/discuss', function () {
    return view('discussions.discuss');
});

Auth::routes();

Route::get('/forum',[
	'uses'=>'ForumsController@index',
	'as'=>'forum'
]);

Route::get('{provider}/auth',[
	'uses'=>'SocialsController@auth',
	'as'=>'social.auth'
]);

Route::get('{provider}/redirect',[
	'uses'=>'SocialsController@auth_callback',
	'as'=>'social.callback'
]);

Route::get('discussion/{slug}',[
		'uses'=>'DiscussionController@show',
		'as'=>'discussion'
	]);


Route::get('channel/{slug}',[
	'uses'=>'ForumsController@channel',
	'as'=>'channel'
]);

Route::group(['middleware'=>'auth'],function(){
	Route::resource('channels','ChannelsController');  //it will register all routes 

	Route::get('discussion/create/new',[
		'uses'=>'DiscussionController@create',
		'as'=>'discussions.create'
	]);
	Route::post('discussion/store',[
		'uses'=>'DiscussionController@store',
		'as'=>'discussions.store'
	]);
	
	Route::post('discussion/reply/{id}',[
		'uses'=>'DiscussionController@reply',
		'as'=>'discussion.reply'
	]);

	Route::get('discussion/edit/{slug}',[
		'uses'=>'DiscussionController@edit',
		'as'=>'discussions.edit'
	]);
	
	Route::post('discussion/update/{id}',[
		'uses'=>'DiscussionController@update',
		'as'=>'discussions.update'
	]);
	
	Route::get('reply/like/{id}',[
		'uses'=>'RepliesController@like',
		'as'=>'reply.like'
	]);
	Route::get('reply/unlike/{id}',[
		'uses'=>'RepliesController@unlike',
		'as'=>'reply.unlike'
	]);

	Route::get('discussion/watch/{id}',[
		'uses'=>'WatchersController@watch',
		'as'=>'discussion.watch'
	]);

	Route::get('discussion/unwatch/{id}',[
		'uses'=>'WatchersController@unwatch',
		'as'=>'discussion.unwatch'
	]);
	Route::get('discussion/best/reply/{id}',[
		'uses'=>'RepliesController@best_answer',
		'as'=>'discussion.best.answer'
	]);
	
});
