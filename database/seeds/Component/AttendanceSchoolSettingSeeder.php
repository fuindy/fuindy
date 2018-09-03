<?php

use Fuindy\Repositories\School\v1\Models\AttendanceSchoolSetting;
use Illuminate\Database\Seeder;

class AttendanceSchoolSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'school-study-time', 'value' => 8, 'description' => 'Regulating teaching and learning activities takes place in each school']
        );

        /** Deleting data in table if has been exist */
        if (AttendanceSchoolSetting::get()->count() > 0) {
            AttendanceSchoolSetting::truncate();
        }

        AttendanceSchoolSetting::insert($data);
    }
}
