@extends('layouts.app')

@section('content')
	
    <div class="panel panel-default">
    		
    		<div class="panel-heading">
    			<img src="{{$d->user->avatar}}" width="40px" height="40px">&nbsp;&nbsp;
    			<span>{{$d->user->name}} <b>({{ $d->user->points }})</b></span>

    			@if(Auth::id() == $d->user->id)
    				<a href="{{ route('discussions.edit',['slug'=>$d->slug]) }}" class="btn btn-xs btn-info pull-right">Edit</a>
    			@endif
    			
    			@if($d->is_being_watched_by_auth_user())
    				<a href="{{ route('discussion.unwatch',['id'=>$d->id]) }}" class="btn btn-default pull-right btn-xs">UnWatch</a>
    			@else
    				<a href="{{ route('discussion.watch',['id'=>$d->id]) }}" class="btn btn-default pull-right btn-xs">Watch</a>
    			@endif
    		</div>

    		<div class="panel-body">
    			<h4 class="text-center"><b>{{$d->title}}</b></h4>
    			
    			<p class="text-center">{{$d->content}}</p>
    			<hr>
    			@if($best_answer)
    				<div class="text-center">
    					<h3 class="text-center" style="padding: 40px;">Best Answer</h3>
    					<div class="panel panel-success">
    						<div class="panel-heading">
    							<img src="{{$best_answer->user->avatar}}" width="40px" height="40px">&nbsp;&nbsp;
    							<span>{{$best_answer->user->name}} <b>({{ $d->user->points }})</b></span>
    						</div>
    						<div class="panel-body">
    							{{$best_answer->content}}
    						</div>
    					</div>
    				</div>
    			@endif
    		</div>

    		<div class="panel-footer">
    			<span>
    				{{$d->replies->count()}} Replies
    			</span>
                <a href="{{ route('channel',['slug'=>$d->channel->slug]) }}" class="pull-right btn btn-default btn-xs">
                    {{$d->channel->title}}
                </a>
    		</div>

    </div>
    
    @foreach($d->replies as $r)

    	<div class="panel panel-default">
    			
    			<div class="panel-heading">
    				<img src="{{$r->user->avatar}}" width="40px" height="40px">&nbsp;&nbsp;
    				<span>{{$r->user->name}},<b>{{$r->created_at->diffForHumans()}}</b></span>
    				@if(!$best_answer)
    					@if(Auth::id()==$d->user->id)   //user who created this discussion can only mark it.
    						<a href="{{ route('discussion.best.answer',['id'=>$r->id]) }}" class="btn btn-xs btn-info pull-right">Mark as best Answer</a>
    					@endif
    				@endif
    			</div>

    			<div class="panel-body">
    				<p class="text-center">{{$r->content}}</p>
    			</div>

    			<div class="panel-footer">
    				@if($r->is_liked_by_auth_user())
    					<a href="{{route('reply.unlike',['id'=>$r->id])}}" class="btn btn-danger">
    						Unlike <span class="badge">{{ $r->likes->count() }}</span>
    					</a>
    				@else
    					<a href="{{route('reply.like',['id'=>$r->id])}}" class="btn btn-success">
    						Like <span class="badge">{{ $r->likes->count() }}</span>
    					</a>
    				@endif
    			</div>

    	</div>

    @endforeach

    <div class="panel panel-default">
    	<div class="panel-body">
    		@if(Auth::check())
    			<form action="{{ route('discussion.reply',['id'=>$d->id]) }}" method="post">
    				{{csrf_field()}}
    				<div class="form-group">
    					<label for="reply">Leave a Reply</label>
    					<textarea name="reply" id="reply" cols="30" rows="18" class="form-control"></textarea>
    				</div>
    				<div class="form-group">
    					<button class="btn btn-success pull-right">Reply</button>
    				</div>
    			</form>
    		@else
    			<div class="text-center">
    				<h2>Sign in to Leave reply.</h2>
    			</div>
    		@endif
    	</div>
    </div>
       
@endsection
