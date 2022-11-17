<?php

namespace App\Helpers;

class MovieCredentials {
    public static function movieCredentialsHeader() {
        return [
            'Content-Type' => 'application/json',
            'X-Authorization' => 'Bearer ' . env('MOVIE_API_USERNAME').":". base64_encode(env('MOVIE_API_PASSWORD'))
        ];
    }
}
