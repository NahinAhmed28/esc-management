<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('admins')->truncate();

        // DB::insert("INSERT INTO `admins` (`id`, `user_type_id`, `role_id`, `division_id`, `district_id`, `upazila_id`, `branch_id`, `code`, `name`, `title_bn`, `title_en`, `office_bn`, `office_en`, `address_bn`, `address_en`, `contact`, `username`, `email`, `area`, `email_verified_at`, `thumb`, `remember_token`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        // (1, 1, 1, 3, 18, 117, NULL, '1', 'Mr.Master Admin', 'মিস্টার মিস্টার এডমিন', 'Mr.Master Admin', 'মাস্টার অ্যাডমিন অফিস', 'Master Admin Office', 'মাস্টার অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Master Admin Office, West Agargaon, Dhaka', '01700000000', '1001', 'superadmin@esc.com', NULL, '2022-07-19 02:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, '2022-07-19 02:01:35', '2022-07-19 04:10:02'),
        // (2, 2, 2, 3, 18, 117, NULL, '2', 'Mr.System Admin', 'মিস্টার সিস্টেম এডমিন', 'Mr.System Admin', 'সিস্টেম অ্যাডমিন অফিস', 'System Admin Office', 'সিস্টেম অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'System Admin Office, West Agargaon, Dhaka', '01700000000', '2001', 'systemadmin@esc.com', NULL, '2022-07-19 02:01:35', NULL, '66XUsklleU', 1, NULL, 1, '2022-07-19 02:01:36', '2022-07-19 04:12:04'),
        // (3, 3, 3, 3, 18, 117, NULL, '3', 'Mr.ADMIN', 'জনাব অ্যাডমিন', 'Mr.Admin', 'অ্যাডমিন অফিস', 'Admin Office', 'অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'A Admin Office, West Agargaon, Dhaka', '01700000000', 'ADMIN', 'admin@esc.com', NULL, '2022-07-19 02:01:36', NULL, '89jKo5EgEUjONy7P15WeYVQLLXhedOvL6awap81JqpFJEPOmxDm3rs3mDyyW', 1, NULL, 1, '2022-07-19 02:01:36', '2022-12-06 05:55:28')");
        
        DB::insert("INSERT INTO `admins` (`id`, `user_type_id`, `role_id`, `association_id`, `area_id`, `branch_id`,  `code`, `name`, `title_bn`, `title_en`, `office_bn`, `office_en`, `address_bn`, `address_en`, `contact`, `username`, `email`, `area`, `email_verified_at`, `thumb`, `remember_token`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 1, 1, NULL, NULL, NULL, '1', 'Mr.Master Admin', 'মিস্টার মিস্টার এডমিন', 'Mr.Master Admin', 'মাস্টার অ্যাডমিন অফিস', 'Master Admin Office', 'মাস্টার অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Master Admin Office, West Agargaon, Dhaka', '01700000000', '1001', 'superadmin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (2, 2, 2, NULL, NULL, NULL, '2', 'Mr.System Admin', 'সিস্টেম অ্যাডমিন', 'Mr.System Admin', 'সিস্টেম অ্যাডমিন অফিস', 'System Admin Office', 'সিস্টেম অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'System Admin Office, West Agargaon, Dhaka', '01700000000', '1002', 'systemadmin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (3, 3, 3, NULL, NULL, NULL, '3', 'MOFA Admin', 'মন্ত্রণালয় অ্যাডমিন', 'MOFA Admin', 'মন্ত্রণালয় অ্যাডমিন অফিস', 'Ministry Admin Office', 'মন্ত্রণালয় অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Ministry Admin Office, West Agargaon, Dhaka', '01700000000', '1003', 'mofa_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (4, 4, 4, NULL, NULL, NULL, '4', 'MOEWOE Admin', 'সচিবালয় অ্যাডমিন', 'MOEWOE Admin', 'সচিবালয় অ্যাডমিন অফিস', 'Secretary Admin Office', 'সচিবালয় অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Secretary Admin Office, West Agargaon, Dhaka', '01700000000', '1004', 'moewoe_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (5, 5, 5, 1, 1, NULL, '5', 'Mr.Embassy Super Admin', 'দূতাবাস ম্যানেজার সুপার অ্যাডমিন', 'Mr.Embassy Super Admin', 'দূতাবাস সুপার অ্যাডমিন অফিস', 'Embassy Super Admin Office', 'দূতাবাস সুপার অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Embassy Super Admin Office, West Agargaon, Dhaka', '01700000000', '1005', 'embassy_super_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (6, 6, 6, 1, 1, NULL, '6', 'Mr.Embassy Admin', 'দূতাবাস অ্যাডমিন', 'Mr.Embassy Admin', 'দূতাবাস অ্যাডমিন অফিস', 'Embassy Admin Office', 'দূতাবাস অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Embassy Admin Office, West Agargaon, Dhaka', '01700000000', '1006', 'embassy_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (7, 7, 7, 1, 1, NULL, '7', 'Mr.Embassy Manager Admin', 'দূতাবাস ম্যানেজার অ্যাডমিন', 'Mr.Embassy Manager Admin', 'দূতাবাস ম্যানেজার অ্যাডমিন অফিস', 'Embassy Manager Admin Office', 'দূতাবাস ম্যানেজার অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Embassy Manager Admin Office, West Agargaon, Dhaka', '01700000000', '1007', 'embassy_manager_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (8, 8, 8, 1, 1, NULL, '8', 'Mr.Embassy Operator Admin', 'দূতাবাস অপারেটর অ্যাডমিন', 'Mr.Embassy Operator Admin', 'দূতাবাস অপারেটর অ্যাডমিন অফিস', 'Embassy Operator Admin Office', 'দূতাবাস অপারেটর অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'Embassy Operator Admin Office, West Agargaon, Dhaka', '01700000000', '1008', 'embassy_operator_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (9, 9, 9, 1, 1, 1, '9', 'Mr.ESC Super Admin', 'ইএসসি সুপার অ্যাডমিন', 'Mr.ESC Super Admin', 'ইএসসি সুপার অ্যাডমিন অফিস', 'ESC Super Admin Office', 'ইএসসি সুপার অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'ESC Super Admin Office, West Agargaon, Dhaka', '01700000000', '1009', 'esc_super_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (10, 10, 10, 1, 1, 1, '10', 'Mr.ESC Admin', 'ইএসসি অ্যাডমিন', 'Mr.ESC Admin', 'ইএসসি অ্যাডমিন অফিস', 'ESC Admin Office', 'ইএসসি অ্যাডমিন অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'ESC Admin Office, West Agargaon, Dhaka', '01700000000', '1010', 'esc_admin@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW()),

        (11, 11, 11, 1, 1, 1, '11', 'Mr.ESC Operator', 'ইএসসি অপারেটর', 'Mr.ESC Operator', 'ইএসসি অপারেটর অফিস', 'ESC Operator Office', 'ইএসসি অপারেটর অফিস, পশ্চিম আগারগাঁও, ঢাকা', 'ESC Operator Office, West Agargaon, Dhaka', '01700000000', '1011', 'esc_operator@esc.com', NULL, '2022-07-18 20:01:35', NULL, 'Ty5OrQghxHeZUinIxn1XAXBKQTlTkFg0F0hsKadw7sUtHjeiBNiVHfM155Em', 1, NULL, 1, NOW(), NOW())
        
        
        
        ");
        

        Schema::enableForeignKeyConstraints();

    }
}