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

class CheckMoviesItemsTitleIdCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GetHttpService;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $items = Cache::get('/v1/items');
        if(count((array)$items) > 0) {
            foreach($items as $item) {
                if(!Cache::has('/v1/items/' . $item->id)) {
                    cache(['/v1/items/' . $item->id => $item], now()->addMinutes(5));
                }
            }
        }
    }
}
