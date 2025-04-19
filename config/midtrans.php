<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-Xi7mz3WqUlAdKzu66vyGg90E'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false), // ✅ default false
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-m6miRdBPmKq_41su'),
];
