<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('site_settings')->truncate();

        \DB::table('site_settings')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'footer_en' => 'Copyright © 2023 Expatriate Smart Centre - ESC,All rights reserved. <br /> 
                    <span style="font-weight: bold">
                      Developed By : 
                      <a style="font-weight: bold; color:green" href="https://a2i.gov.bd/">a2i</a>
                    </span>',
                    'updated_at' => NOW(),
                    'created_at' => NOW(),
                )
        ));
        Schema::enableForeignKeyConstraints();
    }

}
