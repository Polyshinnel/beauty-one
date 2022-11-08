<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Tarifs extends Migration
{
    public function up() {
        $this->schema->create('tarifs',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('type_object');
            $table->integer('specials');
            $table->integer('base_price');
        });

        $tarifs = [
            [
                'location_id' => 1,
                'type_object' => 4,
                'specials' => 1,
                'base_price' => 4500,
            ],
            [
                'location_id' => 1,
                'type_object' => 5,
                'specials' => 1,
                'base_price' => 7500,
            ],
            [
                'location_id' => 1,
                'type_object' => 6,
                'specials' => 1,
                'base_price' => 9900,
            ],
            [
                'location_id' => 1,
                'type_object' => 7,
                'specials' => 1,
                'base_price' => 14990,
            ],
            [
                'location_id' => 1,
                'type_object' => 3,
                'specials' => 1,
                'base_price' => 350,
            ],
            [
                'location_id' => 1,
                'type_object' => 3,
                'specials' => 2,
                'base_price' => 350,
            ],
            [
                'location_id' => 1,
                'type_object' => 3,
                'specials' => 3,
                'base_price' => 350,
            ],
        ];
        foreach ($tarifs as $tarif){
            Capsule::table('tarifs')->insert($tarif);
        }

    }

    public function down()
    {
        $this->schema->drop('tarifs');
    }
}
