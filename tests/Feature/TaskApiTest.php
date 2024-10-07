<?php

namespace Tests\Feature;

use App\Models\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

     // Test for creating a task
    public function test_create_task()
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task description.',
            'status' => 'pending',
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Tasks::all());
        $this->assertEquals('Test Task', Tasks::first()->title);
    }

    // Test for reading all tasks
    public function test_read_all_tasks()
    {
        Tasks::factory()->count(2)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json('data'));
    }

    // Test for reading a single task
    public function test_read_single_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertEquals($task->title, $response->json('data.title'));
    }

    // Test for updating a task
    public function test_update_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'description' => 'Updated task description.',
            'status' => 'completed',
        ]);

        $response->assertStatus(200);
        $this->assertEquals('Updated Task', $task->fresh()->title);
    }

    // Test for deleting a task
    public function test_delete_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertCount(0, Tasks::all());
    }

    // Test for handling a not found task
    public function test_task_not_found()
    {
        $response = $this->getJson('/api/tasks/999');

        $response->assertStatus(404);
    }
}
