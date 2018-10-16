<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SocialAuth; // use facade.


class SocialsController extends Controller
{
    public function auth($provider)
    {
    	return SocialAuth::authorize($provider);     // use facede we registered.

    }

    public function auth_callback($provider)
    {
    	SocialAuth::login($provider,function($user,$details){
    		//dd($details);
    		$user->avatar=$details->avatar;
    		$user->email=$details->email;
    		$user->name=$details->full_name;
    		$user->save();

    		// make password field nullabel in user migration table. and run php artisan migrate:refresh
    	});   //if user gives permission to authorized user redirect to this method and details will be fetched .we have passes callback,this is because if user comes first time than we need to store his data.


    	return redirect('/forum');  // here middleware protecting this route.its gonna check if user is authenticated or not.

    }
}
