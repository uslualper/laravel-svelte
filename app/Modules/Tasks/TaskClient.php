<?php

namespace App\Modules\Tasks;
use App\Modules\Tasks\Services\MockService1;
use App\Modules\Tasks\Services\MockService2;

class TaskClient
{
    public function getTasks()
    {
        $service1 = new MockService1();
        $service2 = new MockService2();
        
        $list1 = $service1->getTasks();
        $list2 = $service2->getTasks();

        $list = $list1->merge($list2);

        return $list;
    }
}
