<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();
        DB::table('roles')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'sort' => '1',
                    'code' => '1',
                    'name' => 'Master Admin',
                    'title_en' => 'Master Admin',
                    'title_bn' => 'মাস্টার এডমিন',
                    'status' => 1,
                    'guard_name' => 'MasterAdmin',
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
                    'guard_name' => 'SystemAdmin',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'sort' => '3',
                    'code' => '3',
                    'name' => 'MOFA Panel', //Ministry of Foreign Affairs
                    'title_en' => 'MOFA Panel',
                    'title_bn' => 'পররাষ্ট্র মন্ত্রণালয় প্যানেল',
                    'status' => 1,
                    'guard_name' => 'MOFAPanel',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'sort' => '4',
                    'code' => '4',
                    'name' => 'MOEWOE Panel',
                    'title_en' => 'MOEWOE Panel', //Ministry of Expatriates Welfare and Overseas Employment
                    'title_bn' => 'প্রবাসী কল্যাণ ও বৈদেশিক কর্মসংস্থান মন্ত্রণালয় প্যানেল',
                    'status' => 1,
                    'guard_name' => 'MOEWOEPanel',
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
                    'guard_name' => 5,
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
                    'guard_name' => 'EmbassySuperAdmin',
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
                    'guard_name' => 'EmbassyManager',
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
                    'guard_name' => 'EmbassyOperator',
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
                    'guard_name' => 'ESCSuperAdmin',
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
                    'guard_name' => 'ESCAdmin',
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
                    'guard_name' => 'ESCOperator',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                )
        ));

        // DB::table('roles')->truncate();
        // DB::table("INSERT INTO `roles` (`id`, `code`, `name`, `title_bn`, `title_en`, `guard_name`, `sort`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        // (1, '1', 'Master Admin', 'মাস্টার এডমিন', 'Master Admin', 'admin', 1, 1, NULL, NULL, '2022-12-06 11:39:21', '2022-12-06 11:39:21'),
        // (2, '2', 'System Admin', 'সিস্টেম অ্যাডমিন', 'System Admin', 'admin', 2, 1, NULL, NULL, '2022-12-06 11:39:21', '2022-12-06 11:39:21'),
        // (3, '3', 'Admin', 'অ্যাডমিন', 'Admin', 'admin', 3, 1, NULL, NULL, '2022-12-06 11:39:21', '2022-12-06 11:39:21'),
        // (4, '4', 'Manager', 'ম্যানেজার', 'Manager', 'admin', 4, 1, NULL, NULL, '2022-12-06 11:39:21', '2022-12-06 11:39:21'),
        // (5, '5', 'Operator', 'অপারেটর', 'Operator', 'admin', 5, 1, NULL, NULL, '2022-12-06 11:39:21', '2022-12-06 11:39:21'),
        // (6, '6', 'Admin For Edit', 'Admin For Edit', 'Admin For Edit', 'admin', 1, 1, NULL, NULL, '2022-12-06 11:49:35', '2022-12-06 11:49:35')");

        

        Schema::enableForeignKeyConstraints();

    }
}