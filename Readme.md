## Миграции

##### Папка с миграциями:

/src/Migration

##### Создание миграции:

php vendor/bin/phinx create НазваниеМиграции -c config-phinx.php

##### Миграция:

php vendor/bin/phinx migrate -c config-phinx.php

##### Ссылка на статью:

https://siipo.la/blog/how-to-use-eloquent-orm-migrations-outside-laravel


## Консольные комманды

##### Запуск парсеров:

php bin/console.php Название комманды




## Комманды api

### Авторизация,получение кода авторизации. Тип запроса GET

Адрес: /getAuth

Параметры: 
1. userId -В качестве userId используется телефон или почта

Описание: Используется для получения кода подтверждения,
для дальнейшей авторизации

Пример:

Адрес: /getAuth?userId=polyshinnel@gmail.com

Ответ:

```json
{
  "error": "none",
  "code": "5233",
  "type": "mail"
}
```

### Авторизация, отправка кода, получение токена. Тип запроса POST

Адрес: /getToken

Параметры:

1. userId - телефон или почта которые ввел пользователь
2. code - код подтверждения полученный при запросе коммандой /getAuth


Описание: Используется для получения токена. По нему 
приложение понимает, что пользователь авторизован

Ответ:

```json
{
  "userId": "polyshinnel@gmail.com",
  "token": "91F82622-B62E-4CFE-A019-D1B301E61F94"
}
```


### Авторизация,проверка токена. Тип запроса POST

Адрес: /checkToken

Параметры:

1. token - токен пользователя

Описание: Используется для проверки актуальности токена

Ответ:

```json
{
  "userId": "polyshinnel@gmail.com",
  "message": "token ok"
}
```



### Получение данных пользователя по токену. Тип запроса GET

Адрес: /getUserData

Параметры:

1. token - токен пользователя

Описание: Используется для получения данных профиля пользователя

Ответ:

```json
{
  "user_id": 1,
  "name": "Андрей",
  "phone": "+79030264456",
  "mail": "polyshinnel@gmail.com"
}
```



### Обновление данных пользователя. Тип запроса POST

Адрес: /updateUser

Параметры:

1. token - токен пользователя
2. name - имя пользователя
3. mail - почта пользователя
4. phone - телефон пользователя

Описание: Используется для обновление данных пользователя

Ответ:

```json
{
  "message": "Данные успешно обновлены",
  "errors": "none"
}
```

В случае ошибок

```json
{
  "message": "none",
  "errors": "Не правильно заполнено поле Телефон"
}
```



### Получение локаций. Тип запроса - GET

Адрес: /locations

Описание: получение списка всех доступных локаций

Ответ:

```json
{
  "locations": [
    {
      "id": 1,
      "name": "Клубный дом Vivaldi",
      "coordinates": "55.66825956907947,37.56365549999997",
      "img": "/assets/images/locations/vivaldi-location.png",
      "county": "Россия",
      "city": "Москва",
      "address": "ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "description": "Vivaldi 6-этажный клубный дом бизнес-класса на юго-западе Москвы. Клубный дом находится вблизи Ленинского и Нахимовского проспектов, и в 10 минутах ходьбы от станции метро «Новые Черёмушки».",
      "underground": "Новые черемушки"
    }
  ]
}
```

### Получение локаций, с учетом расстояния и сортировкой по удалению. Тип запроса - GET

Параметр geo. Указываем широту и долготу через запятую

Адрес: /locations?geo=lat,lon

Описание: получение списка всех доступных локаций,
отсортированных по расстоянию до пользователя. Чем ближе 
локация, тем выше она в списке

Ответ:

```json
{
  "locations": [
    {
      "id": 1,
      "name": "Клубный дом Vivaldi",
      "coordinates": "55.66825956907947,37.56365549999997",
      "img": "/assets/images/locations/vivaldi-location.png",
      "county": "Россия",
      "city": "Москва",
      "address": "ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "description": "Vivaldi 6-этажный клубный дом бизнес-класса на юго-западе Москвы. Клубный дом находится вблизи Ленинского и Нахимовского проспектов, и в 10 минутах ходьбы от станции метро «Новые Черёмушки».",
      "underground": "Новые черемушки",
      "range": 152.77
    }
  ]
}
```

### Получение комнат в локации, тип запроса GET

Адрес: /getListRooms/location_id

Параметры:
1.location_id - id локации для которой запрашивает список комнат

Описание: получение комнат в заданной локации

Ответ:

```json
{
  "rooms": [
    {
      "id": 1,
      "location_id": 1,
      "name": "Кабинет №1",
      "short": "Для косметолога, визажиста, бровиста",
      "img": "/assets/images/rooms/vivaldi/preview/room1.jpg",
      "img_big": "/assets/images/rooms/vivaldi/preview/room1_big.jpg",
      "address": "Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "status": 1
    },
    {
      "id": 2,
      "location_id": 1,
      "name": "Кабинет №2",
      "short": "Для стилиста, колориста",
      "img": "/assets/images/rooms/vivaldi/preview/room2.jpg",
      "img_big": "/assets/images/rooms/vivaldi/preview/room2_big.jpg",
      "address": "Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "status": 1
    },
    {
      "id": 3,
      "location_id": 1,
      "name": "Кабинет №3",
      "short": "Для барбера, стилиста",
      "img": "/assets/images/rooms/vivaldi/preview/room3.jpg",
      "img_big": "/assets/images/rooms/vivaldi/preview/room3_big.jpg",
      "address": "Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "status": 1
    },
    {
      "id": 4,
      "location_id": 1,
      "name": "Кабинет №4",
      "short": "Для стилиста, колориста",
      "img": "/assets/images/rooms/vivaldi/preview/room4.jpg",
      "img_big": "/assets/images/rooms/vivaldi/preview/room4_big.jpg",
      "address": "Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "status": 1
    },
    {
      "id": 5,
      "location_id": 1,
      "name": "Кабинет №5",
      "short": "Для стилиста, колориста, процедур",
      "img": "/assets/images/rooms/vivaldi/preview/room5.jpg",
      "img_big": "/assets/images/rooms/vivaldi/preview/room5_big.jpg",
      "address": "Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi",
      "status": 1
    }
  ]
}
```


### Получение данных по комнате, тип запроса GET

Адрес: /getRoomProp/room_id

Параметры:
1.room_id - идентификатор комнаты

Описание: получение данных о комнате, фото, расходники, места.

В ответе получаем:

1. Список оборудования комнаты
2. Список расходных материалов
3. Список оборудования общего пользования
4. Галлерею
5. Список рабочих мест
6. Тарифы для рабочих мест за час

Ответ:

```json
{
  "name": "Для косметолога, визажиста, бровиста",
  "preview": "/assets/images/rooms/vivaldi/preview/room1_big.jpg",
  "address": "Москва, ул. Новочеремушкинская, 58, клубный дом Vivaldi",
  "status": 1,
  "equipment": [
    "Складной стул визажиста",
    "Косметологическая кушетка-стол",
    "Стул-седло для мастера",
    "Лампа кольцевая",
    "Лампа для видео-света",
    "Мойка для волос",
    "Тележка для инструментов",
    "Шкафчик-локер",
    "Диван, кофейный столик и смарт-тв"
  ],
  "supply": [
    "Шампунь",
    "Одноразовые пеньюары",
    "Одноразовые воротнички",
    "Полотенца"
  ],
  "common": [
    "Капсульная кофемашина",
    "Стаканы, чашки и кофейники",
    "Одноразовые перчатки и маски",
    "Кулер с горячей и холодной водой",
    "Туалет для клиентов коворкинга"
  ],
  "gallery": [
    "/assets/images/rooms/vivaldi/room1/1.jpg",
    "/assets/images/rooms/vivaldi/room1/2.jpg",
    "/assets/images/rooms/vivaldi/room1/3.jpg",
    "/assets/images/rooms/vivaldi/room1/4.jpg",
    "/assets/images/rooms/vivaldi/room1/5.jpg",
    "/assets/images/rooms/vivaldi/room1/6.jpg",
    "/assets/images/rooms/vivaldi/room1/7.jpg",
    "/assets/images/rooms/vivaldi/room1/8.jpg",
    "/assets/images/rooms/vivaldi/room1/9.jpg",
    "/assets/images/rooms/vivaldi/room1/10.jpg"
  ],
  "seats": [
    {
      "id": 1,
      "location_id": 1,
      "seat_type": 3,
      "name": "Место 1",
      "tariffs": [
        {
          "name": "Стандарт",
          "price": 350
        },
        {
          "name": "Более 12 часов",
          "price": 210
        },
        {
          "name": "Ночной",
          "price": 140
        }
      ]
    },
    {
      "id": 6,
      "location_id": 1,
      "seat_type": 3,
      "name": "Место 2",
      "tariffs": [
        {
          "name": "Стандарт",
          "price": 350
        },
        {
          "name": "Более 12 часов",
          "price": 210
        },
        {
          "name": "Ночной",
          "price": 140
        }
      ]
    },
    {
      "id": 7,
      "location_id": 1,
      "seat_type": 1,
      "name": "Место 3",
      "tariffs": [
        {
          "name": "Стандарт",
          "price": 250
        }
      ]
    }
  ]
}
```

### Получение всех бронирований для выбранной команты, тип запроса GET

Адрес: /bookings/seat_id

Параметры: 
1. seat_id - ид рабочего места в комнате

Описание: получение всех броней для комнаты

```json
{
  "booking": [
    {
      "id": 1,
      "user_id": 1,
      "user_name": "Нестеров Андрей",
      "seat_id": 1,
      "order_id": 1,
      "time_start": "2022-11-02 17:00:00",
      "time_end": "2022-11-02 20:30:00"
    }
  ]
}
```

### Проверка возможности бронирования выбранного рабочего места. Тип запроса POST

Адрес: /checkBooking

Параметры:

1. seat_id - ид рабочего места
2. date_start - дата начала бронирования
3. minutes - время бронирования в минутах

Описание: проверка доступности комнаты при броне


В случае если бронирование недоступно:

```json
{
  "answer": "false"
}
```

В случае если бронирование доступно:

```json
{
  "answer": "true"
}
```


### Расчет стоимости бронирования выбранного рабочего места. Тип запроса POST

Адрес: /checkoutSeat

Параметры:

1. seat_id - ид рабочего места
2. date_start - дата начала бронирования
3. minutes - время бронирования в минутах
4. token - токен пользователя

Описание: сводка по стоимости бронирования заданной комнаты,
с учетом текущего тарифа

Ответ:

```json
{
  "hours": 3.5,
  "price_by_hour": 350,
  "tariff_name": "Стандарт",
  "room_name": "Кабинет №1",
  "seat_name": "Место 1",
  "total": 1225
}
```


### Бронирование выбранного места, тип запроса POST

Адрес: /bookingProcessing

Параметры:

1. seat_id - ид рабочего места
2. date_start - дата начала бронирования
3. minutes - время бронирования в минутах
4. token - токен пользователя

Описание: бронирование заданной комнаты, 
заданным пользователем.

Ответ:

При проблемах с бронированием:
```json
{
  "answer": "false"
}
```

При успешном бронировании
```json
{
  "answer": "true"
}
```


### Список броней заданного пользователя

Адрес: /bookingList?token=token

Параметры:

1. token - токен пользователя

Описание: список броней пользователя

Ответ:

```json
{
  "bookings": [
    {
      "booking_status": 1,
      "time_start": "2022-11-02 17:00:00",
      "time_end": "2022-11-02 20:30:00",
      "seat_name": "Место 1",
      "room_name": "Кабинет №1",
      "short": "Для косметолога, визажиста, бровиста",
      "room_img": "/assets/images/rooms/vivaldi/preview/room1.jpg",
      "status_name": "Не оплачено",
      "status_color": "7896E2"
    },
    {
      "booking_status": 2,
      "time_start": "2022-11-02 12:00:00",
      "time_end": "2022-11-02 15:30:00",
      "seat_name": "Место 1",
      "room_name": "Кабинет №1",
      "short": "Для косметолога, визажиста, бровиста",
      "room_img": "/assets/images/rooms/vivaldi/preview/room1.jpg",
      "status_name": "Активно",
      "status_color": "55DF49"
    },
    {
      "booking_status": 1,
      "time_start": "2022-11-02 14:00:00",
      "time_end": "2022-11-02 17:30:00",
      "seat_name": "Место 1",
      "room_name": "Кабинет №3",
      "short": "Для барбера, стилиста",
      "room_img": "/assets/images/rooms/vivaldi/preview/room3.jpg",
      "status_name": "Не оплачено",
      "status_color": "7896E2"
    }
  ],
  "error": "no"
}
```

При ошибке токена:

```json
{
  "error": "token is empty"
}
```
При отсутствии броней:
```json
{
  "error": "empty bookings"
}
```