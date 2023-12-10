<?php
use App\Models\Task;
use Database\Factories\TaskFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;



class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_tasks_from_api()
    {
        // Arrange: Create some tasks in the database
        Task::factory()->count(3)->create();

        // Act: Make a GET request to the index endpoint
        $response = $this->get('/api/tasks');

        // Assert: Check the response status and content
        $response->assertStatus(200)
                 ->assertJsonStructure(['tasks' => []]);
    }

    /** @test */
    public function it_stores_a_new_task_through_api()
    {
        // Arrange: Create task data
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task Description',
            'status' => 'pending',
        ];

        // Act: Make a POST request to the store endpoint with task data
        $response = $this->post('/api/tasks', $taskData);

        // Assert: Check the response status and content
        $response->assertStatus(201)
                 ->assertJson(['task' => $taskData]);

        // Assert: Check if the task is stored in the database
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_shows_details_of_a_specific_task_through_api()
    {
        // Arrange: Create a task in the database
        $task = Task::factory()->create();

        // Act: Make a GET request to the show endpoint for the created task
        $response = $this->get("/api/tasks/{$task->id}");

        // Assert: Check the response status and content
        $response->assertStatus(200)
                 ->assertJson([
                     'task' => [
                         'id' => $task->id,
                         'title' => $task->title,
                         'description' => $task->description,
                         'status' => $task->status,
                     ],
                 ]);
    }

    /** @test */
    public function it_updates_an_existing_task()
    {
        // Create a task in the database
        $task = Task::factory()->create();

        // New data for updating the task
        $updatedData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated Task Description',
            'status' => 'completed',
        ];

        // Make a PUT request to the update endpoint for the created task
        $response = $this->put("/api/tasks/{$task->id}", $updatedData);

        // Assert that the response is successful (status code 200)
        $response->assertStatus(200);

        // Assert that the response contains the updated task data
        $response->assertJson(['task' => $updatedData]);

        // Assert that the task in the database has been updated
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $updatedData['title'],
            'description' => $updatedData['description'],
            'status' => $updatedData['status'],
        ]);
    }

    /** @test */
    public function it_destroys_a_task_through_api()
    {
        // Arrange: Create a task in the database
        $task = Task::factory()->create();

        // Act: Make a DELETE request to the destroy endpoint for the created task
        $response = $this->delete("/api/tasks/{$task->id}");

        // Assert: Check the response status and content
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Task deleted successfully']);

        // Assert: Check if the task is no longer in the database
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
