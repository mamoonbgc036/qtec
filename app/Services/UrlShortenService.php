<?php

namespace App\Services;

class UrlShortenService
{
    public function short_url($id)
    {
        // dd($id);
        $base = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Base62 characters
        $shortKey = '';

        while ($id > 0) {
            $remainder = $id % 62;
            $shortKey = $base[$remainder] . $shortKey;
            $id = intdiv($id, 62);
        }

        return $shortKey;
    }
}
