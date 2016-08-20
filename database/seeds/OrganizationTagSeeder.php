<?php

use Illuminate\Database\Seeder;

class OrganizationTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $org_tag = factory(\App\OrganizationTag::class)->times(10)->make();
        \App\OrganizationTag::insert($org_tag->toArray());
    }
}
