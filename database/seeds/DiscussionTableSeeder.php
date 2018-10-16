<?php

use Illuminate\Database\Seeder;
use App\Discussion;
class DiscussionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1='implementing auth 2 with laravel';
        $t2='software development using java';

        $d1=[
        		'title'=>$t1,
        		'content'=>'auth 2 using laravel 5.6',
        		'channel_id'=>1,
        		'user_id'=>2,
        		'slug'=>str_slug($t1)

        ];
        $d2=[
        		'title'=>$t2,
        		'content'=>'java tutorial',
        		'channel_id'=>1,
        		'user_id'=>1,
        		'slug'=>str_slug($t2)

        ];

        Discussion::create($d1);
        Discussion::create($d2);
    }
}
