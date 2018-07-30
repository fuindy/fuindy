<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $getForeignKey = DB::select("select concat(table_name) as 'table_name', concat(constraint_name) 
        as 'column_name' from information_schema.key_column_usage where table_schema = 'fuindy_db' and referenced_table_name is not null");
        foreach ($getForeignKey as $data) {
            DB::statement('ALTER TABLE ' . $data->table_name . ' DROP FOREIGN KEY ' . $data->column_name);
        }

        $this->call([
            GroupCustomerSeeder::class,
            GroupNotificationSeeder::class,
            GroupOrganisationClassSeeder::class,
            GroupOrganisationSchoolSeeder::class,
            GroupOrganisationTeacherSeeder::class,
            GroupQestionSeeder::class,
            GroupParticipantQuestionTestSeeder::class,
            GroupSchoolSeeder::class,
            PermissionSeeder::class,
            QuestionAnswerSeeder::class,
            ReligionSeeder::class,
            RoleSeeder::class,
            StatusActiveSeeder::class,
            StatusQuestionTestSeeder::class,
            StatusRegistrationSeeder::class,
            StatusStudentSeeder::class,
            StatusTeacherSeeder::class,
            StudentClassSeeder::class,
            TypeQuestionSeeder::class,
        ]);
    }
}
