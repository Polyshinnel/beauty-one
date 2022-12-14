<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class AbonementList extends Migration
{
    public function up() {
        $this->schema->create('subscribtion_list',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
            $table->integer('price');
            $table->integer('minutes');
        });

        $abonementList = [
            [
                'name' => '15 часов',
                'price' => 4500,
                'minutes' => 900
            ],
            [
                'name' => '30 часов',
                'price' => 7500,
                'minutes' => 1800
            ],
            [
                'name' => '50 часов',
                'price' => 9900,
                'minutes' => 3000
            ],
            [
                'name' => '100 часов',
                'price' => 14990,
                'minutes' => 6000
            ],
        ];

        foreach ($abonementList as $abonementItem){
            Capsule::table('subscribtion_list')->insert($abonementItem);
        }
    }

    public function down()
    {
        $this->schema->drop('subscribtion_list');
    }
}
