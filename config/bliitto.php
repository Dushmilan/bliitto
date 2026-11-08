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

];
