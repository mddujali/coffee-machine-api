<?php

declare(strict_types=1);

if ( ! function_exists('period_at_the_end')) {
    function period_at_the_end(string $string): string
    {
        return ! str_ends_with($string, '.') ? $string . '.' : $string;
    }
}

if ( ! function_exists('studly')) {
    function studly(string $string): string
    {
        return Str::studly($string);
    }
}

if ( ! function_exists('capitalize')) {
    function capitalize(string $string): string
    {
        return ucwords(Str::replace('_', ' ', $string));
    }
}
