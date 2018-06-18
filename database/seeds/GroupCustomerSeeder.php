<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Admin'],
            ['name' => 'School'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
            ['name' => 'Visitor']
        );

        if (DB::table('group_customers')->get()->count() > 0) {
            DB::table('group_customers')->truncate();
        }

        DB::table('group_customers')->insert($data);
    }
}
