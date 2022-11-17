<?php

namespace App\Traits\Services;

trait GetHttpService
{
    public function getData(\App\Services\HttpService $service): array|\stdClass
    {
        $response = $service->sendRequest();
        if ($response->status() !== 200)
            throw new \Exception($response->body());
        return json_decode($response->body());
    }
}
