<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class Promocodes extends Migration
{
    public function up() {
        $this->schema->create('promocodes',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',127);
            $table->decimal('value',10,2);
            $table->integer('count_usage_all');
            $table->date('expired_date');
            $table->integer('count_usage_user');
            $table->integer('do_not_combine');
        });

    }

    public function down()
    {
        $this->schema->drop('promocodes');
    }
}
