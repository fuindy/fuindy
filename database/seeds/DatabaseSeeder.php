<?php

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
         $this->call([
             GroupCustomerSeeder::class,
             GroupNotificationSeeder::class,
             CreateGroupQuestionsTable::class,
             GroupSchoolSeeder::class,
             PermissionSeeder::class,
             ReligionSeeder::class,
             RoleSeeder::class,
             StatusActiveSeeder::class,
             StatusRegistrationSeeder::class,
             StatusStudentSeeder::class,
             StatusTeacherSeeder::class,
             TypeQuestionSeeder::class,
         ]);
    }
}
