<?php

use App\Jobs\CheckBookings;

return [
    'console' => [
        'commands' => [
            'CheckExpiredBooking' => CheckBookings::class,
        ]
    ]
];