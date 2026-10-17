<?php

use App\Support\LegacyLink;

if (! function_exists('legacy_link')) {
    /**
     * Resolve a legacy `.php` link from the imported seed content to a route URL.
     */
    function legacy_link(?string $link): string
    {
        return LegacyLink::resolve($link);
    }
}
