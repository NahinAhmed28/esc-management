<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->foreign('role_id', 'roles_permissions_fk_role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            
            // $table->foreign('permission_id', 'roles_permissions_fk_permission_id')
            //     ->references('id')
            //     ->on('permissions')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->dropForeign('roles_permissions_fk_role_id');
            //$table->dropForeign('roles_permissions_fk_permission_id');
        });
    }
}
