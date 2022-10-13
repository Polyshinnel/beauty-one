<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class RoomsAddsType extends Migration
{
    public function up() {
        $this->schema->create('rooms_adds_type',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',127);
        });

        $listTypes = [
            [
                'name' => 'equipment'
            ],
            [
                'name' => 'supply'
            ],
            [
                'name' => 'common'
            ],
            [
                'name' => 'image'
            ],
        ];
        foreach ($listTypes as $listType){
            Capsule::table('rooms_adds_type')->insert($listType);
        }

    }

    public function down()
    {
        $this->schema->drop('rooms_adds_type');
    }
}
