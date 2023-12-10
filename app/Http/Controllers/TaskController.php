<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json(['tasks' => $tasks]);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        // Create a new task
        $task = Task::create($validatedData);

        // Return the created task with a 201 status code
        return response()->json(['task' => $task], 201);
    }

    /**
     * Display the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Validate the incoming $id parameter
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        // Find the task by ID
        $task = Task::find($id);

        // Check if the task exists
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Return the task details
        return response()->json(['task' => $task]);
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the task by ID
        $task = Task::find($id);

        // Check if the task exists
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        // Update the task with the validated data
        $task->update($validatedData);

        // Return the updated task
        return response()->json(['task' => $task]);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Validate the incoming $id parameter
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        // Find the task by ID
        $task = Task::find($id);

        // Check if the task exists
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Delete the task
        $task->delete();

        // Return a success message
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
