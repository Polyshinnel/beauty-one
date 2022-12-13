<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class BookingStatus extends Migration
{
    public function up() {
        $this->schema->create('booking_status',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
            $table->string('color_hex',256);
        });

        $statusList = [
            [
                'name' => 'Не оплачено',
                'color_hex' => 'E93434'
            ],
            [
                'name' => 'Активно',
                'color_hex' => '55DF49'
            ],
            [
                'name' => 'Истекло',
                'color_hex' => '7896E2'
            ],
        ];

        foreach ($statusList as $statusItem){
            Capsule::table('booking_status')->insert($statusItem);
        }
    }

    public function down()
    {
        $this->schema->drop('booking_status');
    }
}
