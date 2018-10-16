<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Channel;
use Auth;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function index()
    {
        switch (request('filter')) {
            case 'me':
                $results=Discussion::where('user_id',Auth::id())->paginate(3);
                break;
            case 'solved':
                $answered=array();
                foreach(Discussion::all() as $d)
                    {
                        if($d->hasBestAnswer())
                        {
                            array_push($answered,$d);
                        }
                    }
                    $results=new Paginator($answered,3); //custom pagination for array values.
                    break;
            default:
                $results=Discussion::orderBy('created_at','desc')->paginate(3);
                break;
        }
    	return view('forum',['discussions'=>$results]);

        //$discussion=Discussion::orderBy('created_at','desc')->paginate(3);
    	//return view('forum',['discussions'=>$discussion]);
    }

    public function channel($slug)
    {
    	$channel=Channel::where('slug',$slug)->first();
    	
    	return view('channels.channels',['discussions'=>$channel->discussions()->paginate(2)]);
    }
}
