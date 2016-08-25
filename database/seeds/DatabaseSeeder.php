<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

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

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('organization_tags')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(UsersTableSeeder::class);
        $this->call(OrganizationTagSeeder::class);

        Model::reguard();
    }
}
