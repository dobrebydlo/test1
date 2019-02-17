<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUnnecessaryColumnsFromPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign('purchases_item_id_foreign');
            $table->dropIndex('purchases_item_id_foreign');
            $table->dropColumn('item_id');
            $table->dropColumn('amount');
            $table->dropColumn('quantity');
            $table->dropColumn('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('item_id')->unsigned()->after('id');
            $table->integer('quantity')->unsigned()->default(1)->after('item_id');
            $table->decimal('price', '8', '2')->unsigned()->after('quantity');
            $table->decimal('amount', '12', '2')->storedAs("`price` * `quantity`")->after('price');

            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }
}
