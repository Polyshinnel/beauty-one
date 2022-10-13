<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class Users extends Migration
{
    public function up() {
        $this->schema->create('users',function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId',127);
            $table->string('code',127);
            $table->string('token',127);
        });
    }

    public function down()
    {
        $this->schema->drop('users');
    }
}
