<?php
declare(strict_types=1);

use \App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

final class RoomsAdds extends Migration
{
    public function up() {
        $this->schema->create('room_adds',function (Blueprint $table) {
            $table->integer('room_id');
            $table->integer('adds_type_id');
            $table->text('value');
        });

        $listAdds = [
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Складной стул визажиста'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Косметологическая кушетка-стол'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Стул-седло для мастера'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Лампа кольцевая'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Лампа для видео-света'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Мойка для волос'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Тележка для инструментов'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Шкафчик-локер'
            ],


            [
                'room_id' => 1,
                'adds_type_id' => 1,
                'value' => 'Диван, кофейный столик и смарт-тв'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Откидывающееся кресло'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Стул-седло для мастера'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Лампа кольцевая'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Мойка для волос'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Тележка для инструментов'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Шкафчик-локер'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 1,
                'value' => 'Диван, кофейный столик и смарт-тв'
            ],


            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Откидывающееся кресло'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Лампа кольцевая'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Мойка для волос'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Весы'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Тележка для инструментов'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Шкафчик-локер'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 1,
                'value' => 'Диван, кофейный столик и смарт-тв'
            ],


            [
                'room_id' => 4,
                'adds_type_id' => 1,
                'value' => 'Откидывающееся кресло'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 1,
                'value' => 'Лампа кольцевая'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 1,
                'value' => 'Мойка для волос'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 1,
                'value' => 'Тележка для инструментов'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 1,
                'value' => 'Шкафчик-локер'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 1,
                'value' => 'Диван, кофейный столик и смарт-тв'
            ],


            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Откидывающееся кресло'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Стул-седло для мастера'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Лампа кольцевая'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Мойка для волос'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Тележка для инструментов'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Шкафчик-локер'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 1,
                'value' => 'Диван, кофейный столик и смарт-тв'
            ],



            [
                'room_id' => 1,
                'adds_type_id' => 2,
                'value' => 'Шампунь'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 2,
                'value' => 'Одноразовые пеньюары'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 2,
                'value' => 'Одноразовые воротнички'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 2,
                'value' => 'Полотенца'
            ],


            [
                'room_id' => 2,
                'adds_type_id' => 2,
                'value' => 'Шампунь'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 2,
                'value' => 'Одноразовые пеньюары'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 2,
                'value' => 'Одноразовые воротнички'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 2,
                'value' => 'Полотенца'
            ],


            [
                'room_id' => 3,
                'adds_type_id' => 2,
                'value' => 'Шампунь'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 2,
                'value' => 'Одноразовые пеньюары'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 2,
                'value' => 'Одноразовые воротнички'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 2,
                'value' => 'Полотенца'
            ],


            [
                'room_id' => 4,
                'adds_type_id' => 2,
                'value' => 'Шампунь'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 2,
                'value' => 'Одноразовые пеньюары'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 2,
                'value' => 'Одноразовые воротнички'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 2,
                'value' => 'Полотенца'
            ],

            [
                'room_id' => 5,
                'adds_type_id' => 2,
                'value' => 'Шампунь'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 2,
                'value' => 'Одноразовые пеньюары'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 2,
                'value' => 'Одноразовые воротнички'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 2,
                'value' => 'Полотенца'
            ],

            [
                'room_id' => 1,
                'adds_type_id' => 3,
                'value' => 'Капсульная кофемашина'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 3,
                'value' => 'Стаканы, чашки и кофейники'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 3,
                'value' => 'Одноразовые перчатки и маски'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 3,
                'value' => 'Кулер с горячей и холодной водой'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 3,
                'value' => 'Туалет для клиентов коворкинга'
            ],

            [
                'room_id' => 2,
                'adds_type_id' => 3,
                'value' => 'Капсульная кофемашина'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 3,
                'value' => 'Стаканы, чашки и кофейники'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 3,
                'value' => 'Одноразовые перчатки и маски'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 3,
                'value' => 'Кулер с горячей и холодной водой'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 3,
                'value' => 'Туалет для клиентов коворкинга'
            ],

            [
                'room_id' => 3,
                'adds_type_id' => 3,
                'value' => 'Капсульная кофемашина'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 3,
                'value' => 'Стаканы, чашки и кофейники'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 3,
                'value' => 'Одноразовые перчатки и маски'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 3,
                'value' => 'Кулер с горячей и холодной водой'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 3,
                'value' => 'Туалет для клиентов коворкинга'
            ],

            [
                'room_id' => 4,
                'adds_type_id' => 3,
                'value' => 'Капсульная кофемашина'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 3,
                'value' => 'Стаканы, чашки и кофейники'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 3,
                'value' => 'Одноразовые перчатки и маски'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 3,
                'value' => 'Кулер с горячей и холодной водой'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 3,
                'value' => 'Туалет для клиентов коворкинга'
            ],

            [
                'room_id' => 5,
                'adds_type_id' => 3,
                'value' => 'Капсульная кофемашина'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 3,
                'value' => 'Стаканы, чашки и кофейники'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 3,
                'value' => 'Одноразовые перчатки и маски'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 3,
                'value' => 'Кулер с горячей и холодной водой'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 3,
                'value' => 'Туалет для клиентов коворкинга'
            ],


            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/rooms/vivaldi/room1/1.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/rooms/vivaldi/room1/2.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/3.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/4.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/5.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/6.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/7.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/8.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/9.jpg'
            ],
            [
                'room_id' => 1,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room1/10.jpg'
            ],


            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/1.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/2.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/3.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/4.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/5.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/6.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/7.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/8.jpg'
            ],
            [
                'room_id' => 2,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room2/9.jpg'
            ],

            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/1.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/2.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/3.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/4.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/5.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/6.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/7.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/8.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/9.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/10.jpg'
            ],
            [
                'room_id' => 3,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room3/11.jpg'
            ],

            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/1.jpg'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/2.jpg'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/3.jpg'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/4.jpg'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/5.jpg'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/6.jpg'
            ],
            [
                'room_id' => 4,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room4/7.jpg'
            ],

            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/1.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/2.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/3.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/4.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/5.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/6.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/7.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/8.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/9.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/10.jpg'
            ],
            [
                'room_id' => 5,
                'adds_type_id' => 4,
                'value' => '/assets/images/rooms/vivaldi/room5/11.jpg'
            ],
        ];

        foreach ($listAdds as $listAdd){
            Capsule::table('room_adds')->insert($listAdd);
        }
    }

    public function down()
    {
        $this->schema->drop('room_adds');
    }
}
