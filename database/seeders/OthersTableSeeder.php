<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OthersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();


        DB::table('office_types')->truncate();
        DB::table('office_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'code' => '1',
                    'title_en' => 'Branch office',
                    'title_bn' => 'শাখা অফিস',
                    'status' => 1,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                )
            // 1 =>
            //     array(
            //         'id' => 2,
            //         'code' => '2',
            //         'title_en' => 'Embassy Office',
            //         'title_bn' => 'দূতাবাস অফিস',
            //         'status' => 1,
            //         'created_at' => NOW(),
            //         'updated_at' => NOW(),
            //     )
        ));

        DB::table('associations')->truncate();
        DB::insert("INSERT INTO `associations` (`id`, `code`, `name`, `title_bn`, `title_en`, `address_bn`, `address_en`, `contact`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, '1', NULL, 'সৌদি আরব', 'Saudi Arabia', 'বাড়ি: ২৭২/৩, ৯ম তলা, পশ্চিম আগারগাঁও', 'House : 272/3, 9th Floor, West Agargaon', '01712616058', 1, 1, 1, NOW(), NOW())");
        

        DB::table('areas')->truncate();
        DB::insert("INSERT INTO `areas` (`id`, `association_id`, `code`, `name`, `title_bn`, `title_en`, `address_bn`, `address_en`, `contact`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 1, '1', NULL, 'সৌদি আরব দূতাবাস', 'Embassy of Saudi Arabia', 'বাড়ি 5 (NE) L, রোড 83, গুলশান-2 1212. ঢাকা', 'House 5 (NE) L,Road 83,Gulshan-2 1212. Dhaka', '028829333', 1, 1, NULL, NOW(), NOW())");

        DB::table('branches')->truncate();
        DB::insert("INSERT INTO `branches` (`id`, `office_type_id`, `association_id`, `area_id`, `code`, `name`, `title_bn`, `title_en`, `address_en`, `address_bn`, `latitude`, `longitude`, `email`, `contact`, `long_url`, `short_url`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 1, 1, 1, '1001', NULL, 'বুড়াইধা শাখা', 'BURAIDHA BRANCH', 'Buraidha Ishara Wihdah, Banglai Market, Beside Of Rafa Super market & Beside Of Akhi Store 02', 'বাড়ি: ২৭২/৩, ৯ম তলা, পশ্চিম আগারগাঁও', '26.3315024', '43.9720396', NULL, '0549039596', 'https://www.google.com/maps/place/BURAIDHA+EDC+(%E0%A6%AC%E0%A7%81%E0%A6%B0%E0%A6%BE%E0%A6%87%E0%A6%A6%E0%A6%BE+%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%AC%E0%A6%BE%E0%A6%B8%E0%A7%80+%E0%A6%B8%E0%A7%87%E0%A6%AC%E0%A6%BE+%E0%A6%95%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%A6%E0%A7%8D%E0%A6%B0+)/@26.3315024,43.9720396,17z/data=!3m1!4b1!4m6!3m5!1s0x157f59555cdac55b:0x43518519d01045b!8m2!3d26.3315024!4d43.9720396!16s%2Fg%2F11swdn27st?hl=en&entry=ttu', 'https://goo.gl/maps/MeTh4nP4bdtp4nVX9', 1, 1, 1, '2023-06-18 06:17:16', '2023-07-05 07:32:33'),
        (2, 1, 1, 1, '1002', NULL, 'রিয়াদ বাথা শাখা', 'RIYADH BATHA BRANCH', 'Head Office: King Faysal Road Near Dhaka Medical, Shamshiya Building (3rd Floor).', 'প্রধান কার্যালয়: ঢাকা মেডিকেলের কাছে কিং ফয়সাল রোড, শামশিয়া বিল্ডিং (৩য় তলা)।', '24.642751989560207', '46.71428408280888', NULL, '0112761564', 'https://www.google.com/maps/place/EDC+a2i/@24.6426691,46.7144021,17z/data=!3m1!4b1!4m6!3m5!1s0x3e2f05ac962dae9d:0x51975fe255fb4380!8m2!3d24.6426691!4d46.7144021!16s%2Fg%2F11hcslrtqw?entry=ttu', 'https://goo.gl/maps/oCE8M9oyTAcn2KPfA', 1, 1, 1, '2023-06-18 06:39:26', '2023-07-05 07:30:36'),
        (3, 1, NULL, 1, '1003', NULL, 'জুবাইল শাখা', 'JUBAIL BRANCH', 'King Abdul Aziz Road, Beside Jubail\r\nCentre Elite Tower Hotel', 'কিং আব্দুল আজিজ রোড, জুবাইলের পাশে\r\nসেন্টার এলিট টাওয়ার হোটেল', '27.0120532', '49.6609404', 'edcaljuball@gmail.com', '0502388874', 'https://www.google.com/maps/place/(EDC)+Bangladesh+Passport+Office+-+Jubail+Branch/@27.0120532,49.6609404,17z/data=!3m1!4b1!4m6!3m5!1s0x3e35a11a6339bda7:0x16f53c75f5f1d8!8m2!3d27.0120532!4d49.6609404!16s%2Fg%2F11lq382bzr?entry=ttu', 'https://maps.app.goo.gl/w4nLP1DsV5oVFgHg8', 1, 1, NULL, '2023-07-05 07:34:50', '2023-07-05 07:34:50')");


        DB::table('categories')->truncate();
        DB::insert("INSERT INTO `categories` (`id`, `code`, `name`, `title_bn`, `title_en`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, '1', NULL, 'ডিফল্ট', 'Default', 1, 1, NULL, NOW(), NOW())");


        DB::table('service_types')->truncate();
        DB::insert("INSERT INTO `service_types` (`id`, `code`, `name`, `title_bn`, `title_en`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, '1', NULL, 'পররাষ্ট্র মন্ত্রণালয়', 'MOEWOE', 1, 1, NULL, '2023-07-05 07:40:16', '2023-07-05 07:40:16'),
        (2, '2', NULL, 'কর্মসংস্থান মন্ত্রণালয়', 'MOFA', 1, 1, NULL, '2023-07-05 07:40:16', '2023-07-05 07:40:16'),
        (3, '3', NULL, 'সব', 'All', 1, 1, NULL, '2023-07-06 04:45:49', '2023-07-06 04:45:49')");
        
        
        DB::table('approvals')->truncate();
        DB::insert("INSERT INTO `approvals` (`id`, `code`, `name`, `title_bn`, `title_en`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, '1', 'Waiting for embassy approval', 'দূতাবাসের অনুমোদনের অপেক্ষায়', 'Waiting for embassy approval', 1, 1, NULL, '2023-07-05 07:40:16', '2023-07-05 07:40:16'),
        (2, '2', 'Waiting for ministry approval', 'মন্ত্রণালয়ের অনুমোদনের অপেক্ষায়', 'Waiting for ministry approval', 1, 1, NULL, '2023-07-05 07:40:16', '2023-07-05 07:40:16'),
        (3, '3', 'Review', 'পুনঃমূল্যায়ন', 'Review', 1, 1, NULL, '2023-07-06 04:45:49', '2023-07-06 04:45:49'),
        (4, '5', 'Rejected', 'প্রত্যাখ্যাত', 'Rejected', 1, 1, NULL, '2023-07-06 04:45:49', '2023-07-06 04:45:49'),
        (5, '5', 'Complete', 'সম্পন্ন', 'Complete', 1, 1, NULL, '2023-07-06 04:45:49', '2023-07-06 04:45:49')");
        

        DB::table('services')->truncate();
        DB::insert("INSERT INTO `services` (`id`, `category_id`, `service_type_id`, `code`, `name`, `title_bn`, `title_en`, `govt_charge`, `service_charge`, `total_charge`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 1, 3, '1', NULL, 'পাসপোর্ট রি-ইস্যু', 'Passport Re-Issue', 100.00, 200.00, 300.00, 1, 1, 1, '2023-07-04 09:36:52', '2023-07-04 09:38:31'),
        (2, 1, 1, '2', NULL, 'প্রবাসী কল্যাণ কার্ড', 'Expatriate Welfare Card', 200.00, 300.00, 500.00, 1, 1, 1, '2023-07-04 09:36:52', '2023-07-04 09:39:26'),
        (3, 1, 2, '3', NULL, 'ডকুমেন্টস সত্যায়ন', 'Attestation of documents', 100.00, 200.00, 300.00, 1, 1, NULL, '2023-07-04 09:40:29', '2023-07-04 09:40:29'),
        (4, 1, 1, '4', NULL, 'পাসপোর্ট নবায়ন প্রতি বছর', 'Passport renewal every year', 2000.00, 200.00, 2200.00, 1, 1, NULL, '2023-07-04 09:41:08', '2023-07-04 09:41:08'),
        (5, 1, 1, '5', NULL, 'ডুপ্লিকেট জন্ম নিবন্ধন এবং জন্ম নিবন্ধন তথ্য সংশোধণের আবেদন', 'Duplicate birth registration and application for correction of birth registration information', 2500.00, 200.00, 2700.00, 1, 1, NULL, '2023-07-04 09:41:33', '2023-07-04 09:41:33'),
        (6, 1, 2, '6', NULL, 'সৌদি পুলিশ ক্লিয়ারেন্স জন্য দূতাবাসের সুপারিশ পত্র', 'Embassy recommendation letter for Saudi Police Clearance', 5000.00, 1000.00, 6000.00, 1, 1, NULL, '2023-07-04 09:43:59', '2023-07-04 09:43:59'),
        (7, 1, 1, '7', NULL, 'ট্রাভেল পার্মিট', 'Travel permit', 1000.00, 50.00, 1050.00, 1, 1, NULL, '2023-07-04 09:44:31', '2023-07-04 09:44:31'),
        (8, 1, 2, '8', NULL, 'ভিনদেশি নাগরিকদের জন্য বাংলাদেশী ভিসার অনলাইন আবেদন।', 'Online application of Bangladesh visa for foreign nationals.', 2000.00, 100.00, 2100.00, 1, 1, NULL, '2023-07-04 09:45:09', '2023-07-04 09:45:09')");
        

        Schema::enableForeignKeyConstraints();

    }
}