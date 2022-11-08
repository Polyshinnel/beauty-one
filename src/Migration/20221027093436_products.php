<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Products extends Migration
{
    public function up() {
        $this->schema->create('products',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',127);
        });

        $products = [
            [
                'name' => 'Абонемент'
            ],
            [
                'name' => 'Часы'
            ],
            [
                'name' => 'Бронирование'
            ],
            [
                'name' => 'Возврат'
            ],
        ];
        foreach ($products as $product){
            Capsule::table('products')->insert($product);
        }
    }

    public function down()
    {
        $this->schema->drop('products');
    }
}
