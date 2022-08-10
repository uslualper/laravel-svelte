<?php
namespace App\Modules\Tasks;

abstract class TaskService
{
    public function setTaskRow(string $code ,int $level, int $duration){
        return [
            'code' => $code,
            'level' => $level,
            'duration' => $duration
        ];
    }
}