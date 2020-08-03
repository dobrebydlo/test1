<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardIdToPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'purchases',
            function (Blueprint $table) {
                $table->char('card_number', 16)->nullable()->after('user_id');
                $table
                    ->foreign('card_number')
                    ->references('number')
                    ->on('cards')
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
        Schema::table(
            'purchases',
            function (Blueprint $table) {
                $table->dropForeign('purchases_card_number_foreign');
                $table->dropIndex('purchases_card_number_foreign');
                $table->dropColumn('card_number');
            }
        );
    }
}
