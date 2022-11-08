<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Locations extends Migration
{
    public function up() {
        $this->schema->create('locations',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('coordinates',128);
            $table->text('img');
            $table->string('county',128);
            $table->string('city',128);
            $table->text('address');
            $table->text('description');
            $table->text('underground')->nullable();
        });

        $createArr = [
            'name' => 'Клубный дом Vivaldi',
            'coordinates' => '55.66825956907947,37.56365549999997',
            'img' => '/assets/images/locations/vivaldi-location.png',
            'county' => 'Россия',
            'city' => 'Москва',
            'address' => 'ул. Новочеремушкинская, 58, клубный дом Vivaldi',
            'description' => 'Vivaldi 6-этажный клубный дом бизнес-класса на юго-западе Москвы. Клубный дом находится вблизи Ленинского и Нахимовского проспектов, и в 10 минутах ходьбы от станции метро «Новые Черёмушки».',
            'underground' => 'Новые черемушки'
        ];

        Capsule::table('locations')->insert($createArr);
    }

    public function down()
    {
        $this->schema->drop('locations');
    }
}
