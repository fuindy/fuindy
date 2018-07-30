<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupOrganisationClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Chairman class'],
            ['name' => 'Vice chairman class'],
            ['name' => 'Secretary class'],
            ['name' => 'Vice secretary class'],
            ['name' => 'Treasurer class'],
            ['name' => 'Vice treasurer class'],
            ['name' => 'Section of cleanliness'],
            ['name' => 'Section of safety'],
            ['name' => 'Section of neatness'],
            ['name' => 'Section of religious'],
            ['name' => 'Section of sport'],
        );

        if (DB::table('group_organisation_classes')->count() > 0) {
            DB::table('group_organisation_classes')->truncate();
        }

        DB::table('group_organisation_classes')->insert($data);
    }
}
