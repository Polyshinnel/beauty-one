<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class AbonementUser extends Migration
{
    public function up() {
        $this->schema->create('subscibtion_user',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subscibtion_id');
            $table->string('transaction_id',128);
            $table->integer('current_time');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('available');
        });
    }

    public function down()
    {
        $this->schema->drop('subscibtion_user');
    }
}
