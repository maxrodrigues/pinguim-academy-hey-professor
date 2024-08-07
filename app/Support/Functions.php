<?php

use App\Models\User;

if (!function_exists('user')) {
    function user(): ?User
    {
        return auth()->check() ? auth()->user() : null;
    }
}
