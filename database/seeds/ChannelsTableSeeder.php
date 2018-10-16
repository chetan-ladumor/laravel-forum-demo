<?php

use Illuminate\Database\Seeder;
use App\Channel;
class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$channel1=['title'=>'Laravel','slug'=>str_slug('Laravel')];
    	$channel2=['title'=>'Wordpress','slug'=>str_slug('Wordpress')];
    	$channel3=['title'=>'java','slug'=>str_slug('java')];
    	$channel4=['title'=>'Networking','slug'=>str_slug('Networking')];
    	$channel5=['title'=>'Android','slug'=>str_slug('Android')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
    }
}
