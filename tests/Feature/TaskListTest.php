<?php

namespace Tests\Feature;

use App\Http\Livewire\TaskList;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TaskListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tasks_page_contains_component(): void
    {
        $this->get('/')->assertSeeLivewire(TaskList::class);
    }

    /** @test */
    public function message_is_displayed_when_no_tasks(): void
    {
        Livewire::test(TaskList::class)->assertSee('You haven\'t added any tasks!', false);
    }

    /** @test */
    public function tasks_are_displayed(): void
    {
        $tasks = Task::factory(10)->create();

        Livewire::test(TaskList::class)->assertSeeInOrder($tasks->pluck('text')->toArray());
    }

    /** @test */
    public function task_can_be_marked_complete(): void
    {
        $task = Task::create(['text' => 'Testing!', 'complete' => false]);

        $this->assertFalse($task->complete);

        Livewire::test(TaskList::class)
            ->set('completing', $task->id)
            ->call('completeTask');

        $task->refresh();

        $this->assertTrue($task->complete);
    }

    /** @test */
    public function task_can_be_deleted(): void
    {
        $task = Task::create(['text' => 'Testing!', 'complete' => false]);

        $this->assertDatabaseHas('tasks', ['text' => 'Testing!']);

        Livewire::test(TaskList::class)
            ->set('deleting', $task->id)
            ->call('deleteTask');

        $this->assertDatabaseMissing('tasks', ['text' => 'Testing!']);
    }

    /** @test */
    public function new_task_is_rendered_after_event_received(): void
    {
        $list = Livewire::test(TaskList::class)->assertDontSee('Testing!');

        Task::create(['text' => 'Testing!']);

        $list->assertDontSee('Testing!')
            ->emit('task-added')
            ->assertSee('Testing!');
    }
}
