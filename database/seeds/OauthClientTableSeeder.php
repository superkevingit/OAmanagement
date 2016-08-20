<?php

use Illuminate\Database\Seeder;

class OauthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oauth_cli = factory(\App\OauthClient::class)->times(1)->make();
        \App\OauthClient::insert($oauth_cli->toArray());
    }
}
