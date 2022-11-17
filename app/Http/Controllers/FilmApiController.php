<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Services\GetHttpService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Helpers\MovieCredentials;

class FilmApiController extends Controller
{
    use GetHttpService;

    public function getItems() {
        try {
              $moviesItems = cache('/v1/items');
            return view('Movies.items', ['movies' => $moviesItems]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }

    public function getItem(int $titleId) {
        try {
            $movieItem = cache('/v1/items/' . $titleId);
            return view('Movies.item', ['item' => $movieItem]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }
}
