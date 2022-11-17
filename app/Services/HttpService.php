<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpService {
    private $url;
    private $timeout;
    private $header;

    public function __construct(string $url, int $timeout = 0, array $header = [])
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->header = $header;
    }

    public function sendRequest()
    {
        return Http::withHeaders($this->header)->timeout($this->timeout)->get($this->url);
    }
}
