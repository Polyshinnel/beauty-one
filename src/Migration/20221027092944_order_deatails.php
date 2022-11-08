<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class OrderDeatails extends Migration
{
    public function up() {
        $this->schema->create('order_details',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('promocode_id');
            $table->integer('product_id');
            $table->integer('booking_id');
            $table->integer('money_value');
            $table->integer('time_value');
            $table->integer('quantity');
        });
    }

    public function down()
    {
        $this->schema->drop('order_details');
    }
}
