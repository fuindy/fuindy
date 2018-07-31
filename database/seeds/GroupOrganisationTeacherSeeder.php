<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupOrganisationTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Homeroom teacher'],
            ['name' => 'Adviser OSIS'],
            ['name' => 'Adviser scout'],
            ['name' => 'Adviser music'],
        );

        if (DB::table('group_organisation_teachers')->count() > 0) {
            DB::table('group_organisation_teachers')->truncate();
        }

        DB::table('group_organisation_teachers')->insert($data);
    }
}
