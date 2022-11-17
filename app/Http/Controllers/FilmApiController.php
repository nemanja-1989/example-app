<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Services\GetHttpService;
use Illuminate\Support\Facades\Log;

class FilmApiController extends Controller
{
    use GetHttpService;

    public function getItems() {
        try {
            return view('Movies.items', ['movies' => cache('/v1/items')]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }

    public function getItem(int $titleId) {
        try {
            return view('Movies.item', ['item' => cache('/v1/items/' . $titleId)]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            exit();
        }
    }
}
