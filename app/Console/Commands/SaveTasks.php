<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Tasks\TaskClient;
use App\Models\Task;

class SaveTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tasks save';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $taskClient = new TaskClient();
        return Task::insert($taskClient->getTasks()->toArray());
    }
}
