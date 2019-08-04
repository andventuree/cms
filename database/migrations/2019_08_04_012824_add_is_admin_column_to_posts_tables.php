<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminColumnToPostsTables extends Migration
{
    /**
     * Run the migrations. `php artisan migrate`
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Since this file just adds a column, the command used "make:migration" didn't include some table columns in the up method to begin with
            $table->tinyinteger('is_admin')->default('0');
        });
    }

    /**
     * Reverse the migrations. `php artisan migrate:rollback`
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
}
