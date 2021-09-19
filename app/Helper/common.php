<?php
if (!function_exists('getCurrentUser')) {
    function getCurrentUser()
    {
        return request()->expectsJson() ? auth('api')->user() : auth()->user();
    }
}
