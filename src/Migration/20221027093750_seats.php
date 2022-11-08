<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Seats extends Migration
{
    public function up() {
        $this->schema->create('seats',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('room_id');
            $table->string('name',128);
            $table->integer('seat_type');
        });

        $seats = [
            [
                'location_id' => 1,
                'room_id' => 1,
                'name' => 'Место 1',
                'seat_type' => 3
            ],
            [
                'location_id' => 1,
                'room_id' => 2,
                'name' => 'Место 1',
                'seat_type' => 3
            ],
            [
                'location_id' => 1,
                'room_id' => 3,
                'name' => 'Место 1',
                'seat_type' => 3
            ],
            [
                'location_id' => 1,
                'room_id' => 4,
                'name' => 'Место 1',
                'seat_type' => 3
            ],
            [
                'location_id' => 1,
                'room_id' => 5,
                'name' => 'Место 1',
                'seat_type' => 3
            ],
        ];
        foreach ($seats as $seat){
            Capsule::table('seats')->insert($seat);
        }

    }

    public function down()
    {
        $this->schema->drop('seats');
    }
}
