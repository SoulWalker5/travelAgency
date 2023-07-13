<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ArrayHelper
{
    /**
     * Transforms array keys to snake_case with foreign keys (example userId => user_id).
     */
    public static function snakeKeysForeignKeys(array $array, array $except = []): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::snakeKeysForeignKeys($value);
            }

            str_contains($key, 'Id')
                ? $result[Str::snake($key)] = $value
                : $result[$key] = $value;
        }

        return $result;
    }
}
