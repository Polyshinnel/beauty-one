<?php

use App\Pages\AuthPage;
use App\Pages\IndexPage;
use App\Pages\RoomPage;
use App\Pages\RoomPageAdds;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->group('/',function (RouteCollectorProxy $group) {
        $group->get('',[IndexPage::class,'get']);
        $group->get('getAuth',[AuthPage::class,'get']);
        $group->get('getListRooms',[RoomPage::class,'get']);
        $group->get('getRoomProp/{id}',[RoomPageAdds::class,'get']);
    });
};