<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class RoomsAdds extends Migration
{
    public function up() {
        $this->schema->create('room_adds',function (Blueprint $table) {
            $table->increments('room_id');
            $table->integer('adds_type_id');
            $table->text('value');
        });
    }

    public function down()
    {
        $this->schema->drop('room_adds');
    }
}
