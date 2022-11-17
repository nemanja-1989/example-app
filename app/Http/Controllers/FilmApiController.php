<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Services\GetHttpService;
use Illuminate\Support\Facades\Log;
use App\Helpers\MovieCredentials;

class FilmApiController extends Controller
{
    use GetHttpService;

    public function getItems() {
        try {
            $moviesItems = $this->getData(new \App\Services\HttpService(env('MOVIE_URI') . 'items', 0, MovieCredentials::movieCredentialsHeader()));
            return view('Movies.items', ['movies' => $moviesItems]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }

    public function getItem(int $titleId) {
        try {
            $movieItem = $this->getData(new \App\Services\HttpService(env('MOVIE_URI') . 'items/' . $titleId, 0, MovieCredentials::movieCredentialsHeader()));
            return view('Movies.item', ['item' => $movieItem]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }
}
