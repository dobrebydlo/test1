<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['customer', 'admin'])->default('customer');
            $table->char('first_name', 127)->nullable();
            $table->char('last_name', 127)->nullable();
            $table->char('name', 255)->storedAs("CONCAT(COALESCE(CONCAT(`first_name`, ' '), ''), COALESCE(`last_name`, ''))");
            $table->char('list_name', 255)->storedAs("CONCAT(COALESCE(CONCAT(`last_name`, ' '), ''), COALESCE(`first_name`, ''))");
            $table->char('email', 255)->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->char('password', 60)->nullable();
            $table->char('remember_token', 100)->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->unique(['email', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
