<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Like;
use Auth;
use Session;
use App\User;

class RepliesController extends Controller
{
    public function like($id)
    {
    	$reply=Reply::find($id);
    	Like::create([
    		'reply_id'=>$id,
    		'user_id'=>Auth::id()

    	]);
    	Session::flash('success','You Liked Reply.');

    	return redirect()->back();
    }

    public function unlike($id)
    {
    	$like=Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
    	$like->delete();
    	Session::flash('success','You UnLiked Reply.');

    	return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply=Reply::find($id);
        $reply->best_answer=1;
        $reply->save();
        $reply->user->points +=100;
        $reply->user->save();
        Session::flash('success','You Marked as best answer.');
        return redirect()->back();
    }
}
