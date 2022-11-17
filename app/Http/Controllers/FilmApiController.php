<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Services\GetHttpService;
use Illuminate\Support\Facades\Log;
use App\Helpers\MovieCredentials;

class FilmApiController extends Controller
{
    use GetHttpService;

    public function getMovies() {
        try {
            $movies = $this->getData(new \App\Services\HttpService(env('MOVIE_ITEMS'), 0, MovieCredentials::movieCredentialsHeader()));
            return view('Movies.movies', ['movies' => $movies]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }
}
