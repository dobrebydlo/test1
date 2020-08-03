<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cards',
            function (Blueprint $table) {
                $table->char('number', 16)->primary();
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('type_id')->unsigned();
                $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table
                    ->dateTime('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))
                    ->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table
                    ->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
                $table
                    ->foreign('type_id')
                    ->references('id')
                    ->on('card_types')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
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
        Schema::dropIfExists('cards');
    }
}
