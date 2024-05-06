<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('site_title', 191)->default('YOUTH ENROLLMENT AND CERTIFICATION')->nullable();
            $table->string('site_web', 191)->default('https://probashi.portal.gov.bd/')->nullable();
            $table->string('site_email', 191)->default('info@esc.gov.bd')->nullable();
            $table->string('site_mobile', 191)->default('0088-02-8333604')->nullable();
            $table->string('site_address_en',256)->default('Ministry of Expatriates Welfare & Overseas Employment, Probashi Kalyan Bhaban, 71-72 Old Elephant Road, Eskaton Garden, Dhaka-1000')->nullable();
            $table->string('site_address_bn',256)->default('প্রবাসী কল্যাণ ও বৈদেশিক কর্মসংস্থান মন্ত্রণালয়, প্রবাসী কল্যাণ ভবন, ৭১-৭২ পুরাতন এলিফ্যান্ট রোড, ঢাকা-১০০০।')->nullable();
            // $table->string('site_description')->default('Lorem Ipsum is simply dummy text of the printing and typesetting industry.')->nullable();
            
            // $table->string('site_logo')->nullable();
            // $table->string('site_favicon')->nullable();

            // $table->string('local_currency', 191)->default('USD')->nullable();
            // $table->string('locale', 191)->default('en-US')->nullable();
            // $table->string('locale_code', 191)->default('en')->nullable();
            // $table->string('locale_symble', 191)->default('$')->nullable();

            // $table->string('meta_tag')->nullable();
            // $table->string('meta_name')->nullable();
            // $table->string('meta_description')->nullable();

            // $table->tinyInteger('show_slider')->default(1);
            // $table->tinyInteger('show_gallary')->default(1);
            // $table->tinyInteger('show_lang')->default(0);
            // $table->tinyInteger('show_logo')->default(0);
            // $table->tinyInteger('show_favicon')->default(0);
            // $table->tinyInteger('row_status')->default(1);
            
            $table->string('mailer', 64)->default('smtp')->nullable();
            $table->string('host', 64)->default('mail.dpg.gov.bd')->nullable();
            $table->smallInteger('port')->default(587)->nullable();
            $table->string('username', 64)->default('noreply@dpg.gov.bd')->nullable();
            $table->string('password', 64)->default('2RoPyzaY')->nullable();
            $table->string('encryption', 64)->default('tls')->nullable();
            
            
            $table->tinyInteger('layout')->default(0);
            $table->float('vat')->nullable()->default(0);


            $table->string('name',128)->default('Expatriate Smart Centre - ESC')->nullable();
            $table->string('title_en',256)->default('Expatriate Smart Centre - ESC')->nullable();
            $table->string('title_bn',256)->default('প্রবাস স্মার্ট সেন্টার')->nullable();
            $table->string('footer_en',512)->default('Copyright © 2023 Expatriate Smart Centre - ESC, All rights reserved.')->nullable();
            $table->string('footer_bn',512)->default('প্রবাস স্মার্ট সেন্টার জন্য কপিরাইট © ২০২৩ ডকুমেন্টেশন। সমস্ত অধিকার সংরক্ষিত.')->nullable();
            $table->string('favicon',128)->nullable();
            $table->string('logo',128)->nullable();
            $table->string('footer_logo',128)->nullable();
            $table->smallInteger('sort')->default(1);
            $table->tinyInteger('status')->default(1);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
