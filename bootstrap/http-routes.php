<?php

use App\Pages\AuthPage;
use App\Pages\BookingsPage;
use App\Pages\IndexPage;
use App\Pages\LocationPage;
use App\Pages\RoomPage;
use App\Pages\RoomPageAdds;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->group('/',function (RouteCollectorProxy $group) {
        $group->get('',[IndexPage::class,'get']);
        $group->get('getAuth',[AuthPage::class,'get']);
        $group->get('locations',[LocationPage::class,'get']);
        $group->get('bookings/{id}',[BookingsPage::class,'get']);
        $group->get('getListRooms/{id}',[RoomPage::class,'get']);
        $group->get('getRoomProp/{id}',[RoomPageAdds::class,'get']);
    });
    $app->post('/getToken',[AuthPage::class,'createToken']);
    $app->post('/checkToken',[AuthPage::class,'checkToken']);
    $app->post('/checkBooking',[BookingsPage::class,'checkBooking']);
};