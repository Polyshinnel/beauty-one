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
            $table->integer('location_id');
            $table->string('name',127);
            $table->string('short',255);
            $table->text('img');
            $table->text('img_big');
            $table->string('address',255);
            $table->integer('status');
        });

        $rooms = [
            [
                'location_id' => '1',
                'name' => 'Кабинет №1',
                'short' => 'Для косметолога, визажиста, бровиста',
                'img' => '/assets/images/rooms/vivaldi/preview/room1.jpg',
                'img_big' => '/assets/images/rooms/vivaldi/preview/room1_big.jpg',
                'address' => 'Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi',
                'status' => 1
            ],
            [
                'location_id' => '1',
                'name' => 'Кабинет №2',
                'short' => 'Для стилиста, колориста',
                'img' => '/assets/images/rooms/vivaldi/preview/room2.jpg',
                'img_big' => '/assets/images/rooms/vivaldi/preview/room2_big.jpg',
                'address' => 'Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi',
                'status' => 1
            ],
            [
                'location_id' => '1',
                'name' => 'Кабинет №3',
                'short' => 'Для барбера, стилиста',
                'img' => '/assets/images/rooms/vivaldi/preview/room3.jpg',
                'img_big' => '/assets/images/rooms/vivaldi/preview/room3_big.jpg',
                'address' => 'Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi',
                'status' => 1
            ],
            [
                'location_id' => '1',
                'name' => 'Кабинет №4',
                'short' => 'Для стилиста, колориста',
                'img' => '/assets/images/rooms/vivaldi/preview/room4.jpg',
                'img_big' => '/assets/images/rooms/vivaldi/preview/room4_big.jpg',
                'address' => 'Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi',
                'status' => 1
            ],
            [
                'location_id' => '1',
                'name' => 'Кабинет №5',
                'short' => 'Для стилиста, колориста, процедур',
                'img' => '/assets/images/rooms/vivaldi/preview/room5.jpg',
                'img_big' => '/assets/images/rooms/vivaldi/preview/room5_big.jpg',
                'address' => 'Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi',
                'status' => 1
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
