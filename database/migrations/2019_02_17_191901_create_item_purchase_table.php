<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPurchaseTable extends Migration
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

        Schema::create('item_purchase', function (Blueprint $table) {
            $table->integer('purchase_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->decimal('price', '8', '2')->unsigned();
            $table->decimal('amount', '12', '2')->storedAs("`price` * `quantity`");

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_purchase');
        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('item_id')->unsigned()->after('id');
            $table->integer('quantity')->unsigned()->default(1)->after('item_id');
            $table->decimal('price', '8', '2')->unsigned()->after('quantity');
            $table->decimal('amount', '12', '2')->storedAs("`price` * `quantity`")->after('price');

            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }
}
