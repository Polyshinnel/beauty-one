<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Subscriptions extends Migration
{
    public function up() {
        $this->schema->create('subscriptions',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('time_val');
            $table->integer('tariff_id');
            $table->integer('location_id');
            $table->integer('available_days');
        });

        $subscriptions = [
            [
                'time_val' => 900,
                'tariff_id' => 1,
                'location_id' => 1,
                'available_days' => 30,
            ],
            [
                'time_val' => 1800,
                'tariff_id' => 2,
                'location_id' => 1,
                'available_days' => 30,
            ],
            [
                'time_val' => 3000,
                'tariff_id' => 3,
                'location_id' => 1,
                'available_days' => 30,
            ],
            [
                'time_val' => 60000,
                'tariff_id' => 4,
                'location_id' => 1,
                'available_days' => 30,
            ],
        ];
        foreach ($subscriptions as $subscription){
            Capsule::table('subscriptions')->insert($subscription);
        }

    }

    public function down()
    {
        $this->schema->drop('subscriptions');
    }
}
