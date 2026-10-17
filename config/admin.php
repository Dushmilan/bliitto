<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin domain
    |--------------------------------------------------------------------------
    |
    | When set, the admin panel is served from this host (for example
    | admin.example.com). When it is empty — the default locally — the admin
    | routes fall back to the `/admin` path prefix so development works
    | without DNS or hosts-file changes.
    |
    */

    'domain' => env('ADMIN_DOMAIN'),

];
