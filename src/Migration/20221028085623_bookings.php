<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class Bookings extends Migration
{
    public function up() {
        $this->schema->create('bookings',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('seat_id');
            $table->integer('order_id');
            $table->integer('booking_status');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
        });
    }

    public function down()
    {
        $this->schema->drop('bookings');
    }
}
