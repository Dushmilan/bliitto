<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

/**
 * Translates the legacy `.php` links stored with the imported content into
 * route URLs, so the seeded data can stay a faithful copy of the old site.
 */
class LegacyLink
{
    public static function resolve(?string $link): string
    {
        if ($link === null || trim($link) === '') {
            return '#';
        }

        $link = trim($link);

        if (! preg_match('/^([a-z0-9\-]+)\.php(#[A-Za-z0-9\-_]+)?$/i', $link, $matches)) {
            return $link;
        }

        $name = strtolower($matches[1]) === 'index' ? 'home' : $matches[1];
        $anchor = $matches[2] ?? '';

        return Route::has($name) ? route($name).$anchor : $link;
    }
}
