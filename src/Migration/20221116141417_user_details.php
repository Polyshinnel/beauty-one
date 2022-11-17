<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class UserDetails extends Migration
{
    public function up() {
        $this->schema->create('user_details',function (Blueprint $table) {
            $table->integer('user_id',11);
            $table->string('name',127);
            $table->string('phone',127);
            $table->string('mail',127);
        });
    }

    public function down()
    {
        $this->schema->drop('user_details');
    }
}

