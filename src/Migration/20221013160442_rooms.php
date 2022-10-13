<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Rooms extends Migration
{
    public function up() {
        $this->schema->create('rooms',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',127);
            $table->string('short',127);
            $table->string('img',127);
            $table->string('status',2);
        });

        $rooms = [
            [
                'name' => 'Кабинет №1',
                'short' => 'Для косметолога, визажиста, бровиста',
                'img' => '/assets/images/preview/room1.jpg',
                'status' => '1'
            ],
            [
                'name' => 'Кабинет №2',
                'short' => 'Для стилиста, колориста',
                'img' => '/assets/images/preview/room2.jpg',
                'status' => '1'
            ],
            [
                'name' => 'Кабинет №3',
                'short' => 'Для барбера, стилиста',
                'img' => '/assets/images/preview/room3.jpg',
                'status' => '1'
            ],
            [
                'name' => 'Кабинет №4',
                'short' => 'Для стилиста, колориста',
                'img' => '/assets/images/preview/room4.jpg',
                'status' => '1'
            ],
            [
                'name' => 'Кабинет №5',
                'short' => 'Для стилиста, колориста, процедур',
                'img' => '/assets/images/preview/room5.jpg',
                'status' => '1'
            ],
        ];

        foreach ($rooms as $room){
            Capsule::table('rooms')->insert($room);
        }
    }

    public function down()
    {
        $this->schema->drop('rooms');
    }
}
