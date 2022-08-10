<?php

namespace App\Modules\Tasks\Services;

use App\Modules\Tasks\IService;
use App\Modules\Tasks\TaskService;
use Illuminate\Support\Facades\Http;

class MockService2 extends TaskService implements IService
{
    private $url = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';
    public function getTasks()
    {
        $response = json_decode(Http::get($this->url));

        $collection = collect($response)->map(function ($item) {
            $key = array_keys(get_object_vars($item));
            return $this->setTaskRow($key[0], $item->{$key[0]}->level, $item->{$key[0]}->estimated_duration);
        });
        return $collection;
    }
}