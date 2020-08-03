<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'items',
            function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('price', '8', '2')->unsigned()->default(0);
                $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('updated_at')->default(
                    DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')
                )->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->string('name')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
