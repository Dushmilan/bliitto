<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Casts a date-only column so it is stored as `Y-m-d`.
 *
 * The built-in `date` cast serialises through the model's datetime format,
 * which writes `Y-m-d H:i:s` and is only silently truncated by strict
 * databases such as MySQL. Storing the date explicitly keeps comparisons
 * and seeds correct on every driver, including SQLite.
 *
 * @implements CastsAttributes<Carbon, mixed>
 */
class DateOnly implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Carbon
    {
        return $value === null ? null : Carbon::parse($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value === null ? null : Carbon::parse($value)->toDateString();
    }
}
