<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsertypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('user_types')->truncate();
        DB::table('user_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'sort' => '1',
                    'code' => '1',
                    'name' => 'Master Admin',
                    'title_en' => 'Master Admin',
                    'title_bn' => 'মাস্টার এডমিন',
                    'status' => 1,
                    'default_role' => 1,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'sort' => '2',
                    'code' => '2',
                    'name' => 'System Admin',
                    'title_en' => 'System Admin',
                    'title_bn' => 'সিস্টেম অ্যাডমিন',
                    'status' => 1,
                    'default_role' => 2,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'sort' => '3',
                    'code' => '3',
                    'name' => 'MOFA Panel', // Ministry of Foreign Affairs
                    'title_en' => 'MOFA Panel',
                    'title_bn' => 'পররাষ্ট্র মন্ত্রণালয় প্যানেল',
                    'status' => 1,
                    'default_role' => 3,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'sort' => '4',
                    'code' => '4',
                    'name' => 'MOEWOE Panel', //Ministry of Expatriates Welfare and Overseas Employment
                    'title_en' => 'MOEWOE Panel',
                    'title_bn' => 'প্রবাসী কল্যাণ ও বৈদেশিক কর্মসংস্থান মন্ত্রণালয় প্যানেল',
                    'status' => 1,
                    'default_role' => 4,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            4 =>
                array(
                    'id' => 5,
                    'sort' => '5',
                    'code' => '5',
                    'name' => 'Embassy Super Admin',
                    'title_en' => 'Embassy Super Admin',
                    'title_bn' => 'দূতাবাস সুপার এডমিন',
                    'status' => 1,
                    'default_role' => 5,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            5 =>
                array(
                    'id' => 6,
                    'sort' => '6',
                    'code' => '6',
                    'name' => 'Embassy Admin',
                    'title_en' => 'Embassy Admin',
                    'title_bn' => 'দূতাবাস এডমিন',
                    'status' => 1,
                    'default_role' => 6,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            6 =>
                array(
                    'id' => 7,
                    'sort' => '7',
                    'code' => '7',
                    'name' => 'Embassy Manager',
                    'title_en' => 'Embassy Manager',
                    'title_bn' => 'দূতাবাস ম্যানেজার',
                    'status' => 1,
                    'default_role' => 7,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            7 =>
                array(
                    'id' => 8,
                    'sort' => '8',
                    'code' => '8',
                    'name' => 'Embassy Operator',
                    'title_en' => 'Embassy Operator',
                    'title_bn' => 'দূতাবাস অপারেটর',
                    'status' => 1,
                    'default_role' => 8,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            8 =>
                array(
                    'id' => 9,
                    'sort' => '9',
                    'code' => '9',
                    'name' => 'ESC Super Admin',
                    'title_en' => 'ESC Super Admin',
                    'title_bn' => 'ইএসসি সুপার এডমিন',
                    'status' => 1,
                    'default_role' => 9,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            9 =>
                array(
                    'id' => 10,
                    'sort' => '10',
                    'code' => '10',
                    'name' => 'ESC Admin',
                    'title_en' => 'ESC Admin',
                    'title_bn' => 'ইএসসি এডমিন',
                    'status' => 1,
                    'default_role' => 10,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            10 =>
                array(
                    'id' => 11,
                    'sort' => '11',
                    'code' => '11',
                    'name' => 'ESC Operator',
                    'title_en' => 'ESC Operator',
                    'title_bn' => 'ইএসসি অপারেটর',
                    'status' => 1,
                    'default_role' => 11,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                )
        ));
        

        Schema::enableForeignKeyConstraints();

    }
}