<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Developer;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function calculate(){

        $tasks = Task::selectRaw('*,(level*duration) as cost')->orderBy('cost','DESC')->get()->toArray();
        $developers = Developer::all()->toArray();
        $plan = [];

        foreach($tasks as $i => $task){
            $cost = $task['cost'];
            $findDevWeek = $this->findFreeCapacity($developers,$cost);
            $devIndex = null;
            if($findDevWeek['developer'] !== null){  
                if(array_key_exists($findDevWeek['weekIndex'],$plan)){
                    foreach($plan[$findDevWeek['weekIndex']]['developers'] as $j => $weekDev){
                        if($weekDev['developer']['id'] === $findDevWeek['developer']['id']){
                             $devIndex = $j;                        
                        }
                    }
                }               
               if($devIndex !== null){
                    $plan[$findDevWeek['weekIndex']]['developers'][$devIndex]['tasks'][] = $task;
               }else{
                    $plan[$findDevWeek['weekIndex']]['developers'][] = [
                        'developer' => $findDevWeek['developer'],
                        'tasks' => [$task]
                    ];
               }
               if(array_key_exists('cost',$plan[$findDevWeek['weekIndex']])){
                    $plan[$findDevWeek['weekIndex']]['cost'] += $cost;
                }else{
                    $plan[$findDevWeek['weekIndex']]['cost'] = $cost;
                }
            }
        }

        return [
            'weeks' => $plan
        ];
    }

    private function findFreeCapacity(&$developers,$cost,$weekIndex = 0){
        $capacity = 45;
        $maxWeekIndex = 48;
        $find = [
            'developer' => null,
            'weekIndex' => null,
        ];
        foreach($developers as $i => &$dev){
            if(!array_key_exists($weekIndex,$dev)){
                $dev[$weekIndex]['capacity'] = $capacity;
            }
            if($dev[$weekIndex]['capacity'] >= $cost / $dev['level']){
                $find['developer'] = [
                    'id' => $dev['id'],
                    'name' => $dev['name'],
                    'level' => $dev['level'],
                ];
                $find['weekIndex'] = $weekIndex;
                $dev[$weekIndex]['capacity'] -= $cost / $dev['level'];
                break;
            }
        }
        if($find['developer'] == null && $maxWeekIndex > $weekIndex){
            $weekIndex++;
            $find = $this->findFreeCapacity($developers,$cost,$weekIndex);
        }
        return $find;
    }
}
