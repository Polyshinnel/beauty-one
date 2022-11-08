<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class TarifSpecials extends Migration
{
    public function up() {
        $this->schema->create('tariff_specials',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',127);
            $table->decimal('coefficient',10,2);
            $table->integer('hours')->nullable();
            $table->string('days_of_week',20)->nullable();
            $table->string('days_of_month',50)->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_finish')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_for')->nullable();
            $table->integer('priority');
        });

        $listSpecials = [
            [
                'name' => 'Стандарт',
                'coefficient' => 1,
                'hours' => NULL,
                'days_of_week' => NULL,
                'days_of_month' => NULL,
                'time_start' => NULL,
                'time_finish' => NULL,
                'valid_from' => '2022-09-04',
                'valid_for' => '2025-10-31',
                'priority' => 10,
            ],
            [
                'name' => 'Более 12 часов',
                'coefficient' => 0.6,
                'hours' => 12,
                'days_of_week' => NULL,
                'days_of_month' => NULL,
                'time_start' => NULL,
                'time_finish' => NULL,
                'valid_from' => '2022-09-04',
                'valid_for' => '2025-10-31',
                'priority' => 20,
            ],
            [
                'name' => 'Ночной',
                'coefficient' => 0.4,
                'hours' => NULL,
                'days_of_week' => NULL,
                'days_of_month' => NULL,
                'time_start' => '22:00',
                'time_finish' => '8:00',
                'valid_from' => '2022-09-04',
                'valid_for' => '2025-10-31',
                'priority' => 30,
            ],
            [
                'name' => 'Горячие часы',
                'coefficient' => 1.15,
                'hours' => NULL,
                'days_of_week' => 2,
                'days_of_month' => NULL,
                'time_start' => NULL,
                'time_finish' => NULL,
                'valid_from' => '2022-09-04',
                'valid_for' => '2025-10-31',
                'priority' => 40,
            ],
        ];


        foreach ($listSpecials as $specialItem){
            Capsule::table('tariff_specials')->insert($specialItem);
        }

    }

    public function down()
    {
        $this->schema->drop('tariff_specials');
    }
}
