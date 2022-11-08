<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class SeatType extends Migration
{
    public function up() {
        $this->schema->create('seats_type',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',127);
        });

        $listTypes = [
            [
                'name' => 'Рабочее место'
            ],
            [
                'name' => 'Оборудованое рабочее место'
            ],
            [
                'name' => 'Отдельная комната'
            ]
        ];
        foreach ($listTypes as $listType){
            Capsule::table('seats_type')->insert($listType);
        }

    }

    public function down()
    {
        $this->schema->drop('seats_type');
    }
}
