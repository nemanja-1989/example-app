<?php

namespace App\Jobs;

use App\Helpers\MovieCredentials;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\Services\GetHttpService;
use Illuminate\Support\Facades\Cache;

class CheckMoviesItemsCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GetHttpService;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!Cache::has('/v1/items')) {
            Cache::put('/v1/items', $this->getData(new \App\Services\HttpService(env('MOVIE_URI') . 'items', 0, MovieCredentials::movieCredentialsHeader())), now()->addSeconds(30));
            foreach(Cache::get('/v1/items') as $item) {
                if(!Cache::has('/v1/items/' . $item->id)) {
                    Cache::put('/v1/items/' . $item->id, $item, now()->addSeconds(30));
                }
            }
        }
    }
}
