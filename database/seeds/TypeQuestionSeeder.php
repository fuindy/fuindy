<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Akuntansi', 'status' => '2'],
            ['name' => 'Matematika', 'status' => '2'],
            ['name' => 'Bahasa Indonesia', 'status' => '2'],
            ['name' => 'Bahasa Inggris', 'status' => '2'],
            ['name' => 'IPS (Ilmu Pengetahuan Sosial)', 'status' => '2'],
            ['name' => 'PKN (Pendidikan Kewarganegaraan)', 'status' => '2'],
            ['name' => 'Olahraga', 'status' => '2'],
            ['name' => 'TIK (Teknologi Informasi & Komunikasi)', 'status' => '2'],
            ['name' => 'Agama', 'status' => '2'],
            ['name' => 'IPA (Fisika)', 'status' => '2'],
            ['name' => 'IPA (Biologi)', 'status' => '2'],
            ['name' => 'IPA (Kimia)', 'status' => '2'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('type_questions')->get()->count() > 0) {
            DB::table('type_questions')->truncate();
        }

        DB::table('type_questions')->insert($data);
    }
}
