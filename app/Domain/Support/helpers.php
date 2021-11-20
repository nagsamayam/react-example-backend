<?php

declare(strict_types=1);

if (!function_exists('is_production')) {
    function is_production(): bool
    {
        return app()->environment() === 'production';
    }
}

if (!function_exists('get_app_locale')) {
    function get_app_locale(): string
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if (!function_exists('get_app_name')) {
    function get_app_name()
    {
        return config('app.name', 'MitoticMoney');
    }
}

if (!function_exists('page_title')) {
    function page_title($title = null): string
    {
        $page_title = get_app_name();
        if ($title) {
            $page_title .= ' | ' . $title;
        }

        return $page_title;
    }
}

if (!function_exists('referer_url')) {
    function referer_url(): string | null
    {
        return request()->headers->get('referer');
    }
}
