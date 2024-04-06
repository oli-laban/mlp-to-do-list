<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tasks_page_contains_component(): void
    {
        $this->get('/')->assertSeeLivewire(CreateTask::class);
    }

    /** @test */
    public function cannot_submit_with_empty_text(): void
    {
        Livewire::test(CreateTask::class)
            ->set('text', '')
            ->call('submit')
            ->assertHasErrors(['text' => 'required'])
            ->assertSee('The text field is required.');
    }

    /** @test */
    public function cannot_submit_text_exceeding_character_limit(): void
    {
        $text = Str::random(301);

        Livewire::test(CreateTask::class)
            ->set('text', $text)
            ->call('submit')
            ->assertHasErrors(['text' => 'max'])
            ->assertSee('The text must not be greater than 300 characters.');
    }

    /** @test */
    public function task_is_created_successfully(): void
    {
        Livewire::test(CreateTask::class)
            ->set('text', 'Testing!')
            ->call('submit');

        $this->assertDatabaseHas('tasks', ['text' => 'Testing!']);
    }

    /** @test */
    public function successful_submit_emits_event(): void
    {
        Livewire::test(CreateTask::class)
            ->set('text', 'Testing!')
            ->call('submit')
            ->assertEmitted('task-added');
    }

    /** @test */
    public function unsuccessful_submit_does_not_emit_event(): void
    {
        Livewire::test(CreateTask::class)
            ->call('submit')
            ->assertNotEmitted('task-added');
    }
}
