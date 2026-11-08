<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact form recipient
    |--------------------------------------------------------------------------
    |
    | Where notifications for messages submitted through the public contact
    | form are sent. The submitter's own address is used as Reply-To so staff
    | can reply straight from their mail client.
    |
    */

    'contact_recipient' => env('CONTACT_RECIPIENT_EMAIL', 'bliitto@pdn.ac.lk'),

    /*
    |--------------------------------------------------------------------------
    | Demo account
    |--------------------------------------------------------------------------
    |
    | Credentials for the seeded demonstration administrator. The credentials
    | are shown on the login screen only when SHOW_DEMO_CREDENTIALS is true,
    | which should be reserved for disposable demonstration deployments.
    |
    */

    'demo_admin_name' => env('DEMO_ADMIN_NAME', 'Demo Administrator'),
    'demo_admin_email' => env('DEMO_ADMIN_EMAIL', 'admin@bliitto.demo'),
    'demo_admin_password' => env('DEMO_ADMIN_PASSWORD', 'demo-bliitto-2026'),
    'show_demo_credentials' => (bool) env('SHOW_DEMO_CREDENTIALS', false),

];
