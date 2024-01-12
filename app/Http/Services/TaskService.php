<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService
{
    public function __construct()
    {
        //
    }

    public function create($request)
    {
        return Task::create($request->all());
    }

    public function update($request, Task $task)
    {
        $task->name = $request->name;
        $task->description = $request->description;

        return $task->update();
    }
}
