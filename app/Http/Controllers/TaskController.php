<?php

namespace App\Http\Controllers;
use App\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //

    public function index()
    {
        $tasks = auth()->user()->tasks;
 
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }
 
    public function show($id)
    {
        $task = auth()->user()->tasks()->find($id);
 
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $task->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
            'description' => 'required'
        ]);
 
        $task = new Task();
        $task->task = $request->task;
        $task->description = $request->description;
 
        if (auth()->user()->tasks()->save($task))
            return response()->json([
                'success' => true,
                'data' => $task->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Task could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $task = auth()->user()->tasks()->find($id);
 
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $task->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Task could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $task = auth()->user()->tasks()->find($id);
 
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Tasks with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($task->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Task could not be deleted'
            ], 500);
        }
    }

  
}
