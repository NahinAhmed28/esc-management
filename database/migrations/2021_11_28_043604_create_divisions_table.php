<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('title_en')->nullable();
            $table->char('bbs_code', 2)->nullable();

            //$table->smallInteger('sort')->default(1);
            //$table->boolean('office_type')->nullable()->default(true)->comment('Regular = 1, Irregular = 0');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('divisions');
    }
}
