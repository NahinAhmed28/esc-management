<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();

            $table->unsignedMediumInteger('association_id')->nullable()->index('applications_fk_association_id');
            $table->unsignedMediumInteger('area_id')->nullable()->index('applications_fk_area_id');
            $table->unsignedBigInteger('branch_id')->nullable()->index('applications_fk_branch_id');
            
            $table->unsignedMediumInteger('approval_id')->nullable()->default(1)->index('applications_fk_approval_id');
            $table->unsignedMediumInteger('category_id')->nullable()->default(1)->index('applications_fk_category_id');
            $table->unsignedMediumInteger('service_id')->nullable()->default(1)->index('applications_fk_service_id');
            $table->unsignedSmallInteger('service_type_id')->nullable()->default(1)->index('applications_fk_service_type_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('applications_fk_user_id');


            $table->string('name')->nullable();
            
            $table->string('title_bn')->nullable();
            $table->string('title_en')->nullable();
            $table->string('contact',16)->nullable();
            $table->string('email')->nullable();
            $table->string('nid',18)->nullable();
            $table->string('passport',23)->nullable();
            $table->date('dob')->nullable();
            $table->boolean('gender')->default(1)->comment('1=Male,0=Female');
            $table->boolean('marital')->default(1)->comment('1=Married ,0=Unmarried');
            $table->string('father_bn')->nullable();
            $table->string('father_en')->nullable();
            $table->string('address_bn')->nullable();
            $table->string('address_en')->nullable();
            $table->string('spouse_bn')->nullable();
            $table->string('spouse_en')->nullable();

            $table->string('dsign',128)->nullable();

            $table->double('govt_charge', 10, 2)->nullable()->default(0);
            $table->double('service_charge', 10, 2)->nullable()->default(0);
            $table->double('vat', 10, 2)->nullable()->default(0);
            $table->double('total_charge', 10, 2)->nullable()->default(0);
            $table->smallInteger('approval_status')->default(0)->comment('0=pending esc, 1=approved by embassy, 2=approved by ministry');
            $table->tinyInteger('status')->default(1);
            $table->integer('approved_by')->nullable();
            $table->integer('cancel_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();


            $table->date('entry_date')->nullable();
            
            $table->timestamps();
            $table->foreign('association_id', 'applications_fk_association_id')
                ->references('id')
                ->on('associations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('area_id', 'applications_fk_area_id')
                ->references('id')
                ->on('areas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('branch_id', 'applications_fk_branch_id')
                ->references('id')
                ->on('branches')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('approval_id', 'applications_fk_approval_id')
                ->references('id')
                ->on('approvals')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('category_id', 'applications_fk_category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('service_id', 'applications_fk_service_id')
                ->references('id')
                ->on('services')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('service_type_id', 'applications_fk_service_type_id')
                ->references('id')
                ->on('service_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('user_id', 'applications_fk_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
