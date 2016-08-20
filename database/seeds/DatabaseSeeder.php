<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
/*
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('organization_tags')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');*/

        $this->call(UsersTableSeeder::class);
        $this->call(OrganizationTagSeeder::class);
        $this->call(OauthClientTableSeeder::class);

        Model::reguard();
    }
}
