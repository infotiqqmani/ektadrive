<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('imageExists')) {
    function imageExists($path)
    {
        return Storage::exists($path);
    }
}
