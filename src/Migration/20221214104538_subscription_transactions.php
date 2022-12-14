<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class SubscriptionTransactions extends Migration
{
    public function up() {
        $this->schema->create('user_transactions',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('unique_transaction_id',32);
            $table->integer('money_cost');
        });
    }

    public function down()
    {
        $this->schema->drop('user_transactions');
    }
}
