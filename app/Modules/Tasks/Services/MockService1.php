<?php

namespace App\Modules\Tasks\Services;

use App\Modules\Tasks\IService;
use App\Modules\Tasks\TaskService;
use Illuminate\Support\Facades\Http;

class MockService1 extends TaskService implements IService
{
    private $url = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';
    public function getTasks()
    {
        $response = json_decode(Http::get($this->url));

        $collection = collect($response)->map(function ($item) {
            return $this->setTaskRow($item->id, $item->zorluk, $item->sure);
        });
        return $collection;
    }
}