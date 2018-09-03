<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupOrganisationSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Chairman OSIS'],
            ['name' => 'Vice chairman OSIS'],
            ['name' => 'Secretary OSIS'],
            ['name' => 'Vice secretary OSIS'],
            ['name' => 'Treasurer OSIS'],
            ['name' => 'Vice treasurer OSIS'],
            ['name' => 'Public relations'],
            ['name' => 'Section of cleanliness'],
            ['name' => 'Section of safety'],
            ['name' => 'Section of neatness'],
            ['name' => 'Section of religious'],
            ['name' => 'Section of sport'],
        );

        if (DB::table('group_organisation_schools')->count() > 0) {
            DB::table('group_organisation_schools')->truncate();
        }

        DB::table('group_organisation_schools')->insert($data);
    }
}
