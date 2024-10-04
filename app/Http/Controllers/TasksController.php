<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
   use ApiResponse;
    public function index()
    {
        $tasks = Tasks::latest()->get();
        return $this->success('Tasks fetched successfully',$tasks->toArray(), 200);
    }

 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:completed,pending,in-progress'
        ]);

        if($validator->fails()){
            $data = $validator->errors()->toArray();
            return $this->error('Validation Error', $data, 400);
        } 
        $task = Tasks::create($validator->validated());
        return $this->success('Task created successfully', $task->toArray(), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($task)
    {
        $task = Tasks::find($task);
        if (empty($task)) {
            return $this->error('Task not found', [], 404);
        }
        return $this->success('Task fetched successfully', $task->toArray(), 200);
    }

    
    public function update(Request $request, Tasks $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:completed,pending,in-progress'
        ]);

        if($validator->fails()){
            $data = $validator->errors()->toArray();
            return $this->error('Validation Error', $data, 400);
        } 

        $task->update($validator->validated());
        return response()->json(['success' => true, 'data' => $task]);
    }

    public function destroy()
    {
        $task = Tasks::find(request('id'));
        if (!$task) {
           return $this->error('Task not found', [], 404);
        }

        $task->delete();

        return $this->success('Task deleted successfully', [], 200);
    }

}
