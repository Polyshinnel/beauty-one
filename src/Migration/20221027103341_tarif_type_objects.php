<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class TarifTypeObjects extends Migration
{
    public function up() {
        $this->schema->create('tarif_type_objects',function (Blueprint $table) {
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
            ],
            [
                'name' => 'Абонемент 1'
            ],
            [
                'name' => 'Абонемент 2'
            ],
            [
                'name' => 'Абонемент 3'
            ],
            [
                'name' => 'Абонемент 4'
            ],
        ];
        foreach ($listTypes as $listType){
            Capsule::table('tarif_type_objects')->insert($listType);
        }

    }

    public function down()
    {
        $this->schema->drop('tarif_type_objects');
    }
}
