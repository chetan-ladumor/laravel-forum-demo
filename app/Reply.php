<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Reply extends Model
{
    protected $fillable=['user_id','discussion_id','content','best_answer'];

    public function discussion()
    {
    	return $this->belongsTo('App\Discussion');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function likes()
    {
    	return $this->hasmany('App\Like');
    }

    public function is_liked_by_auth_user()
    {
        $id=Auth::id();
        $likers=array();
        foreach($this->likes as $like):
            array_push($likers,$like->user_id);
        endforeach;

        if(in_array($id,$likers))
        {
            return true;
        } 
        else
        {
            return false;
        }  
    }
}
