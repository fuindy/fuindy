<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Chatting'],
            ['name' => 'Registration student'],
        );

        if (DB::table('group_notifications')->get()->count() > 0) {
            DB::table('group_notifications')->truncate();
        }

        DB::table('group_notifications')->insert($data);
    }
}
