<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateTask extends Component
{
    /**
     * The new task's text.
     *
     * @var string
     */
    public string $text = '';

    /**
     * The component's validation rules.
     *
     * @var array
     */
    public array $rules = [
        'text' => 'required|string|max:300',
    ];

    /**
     * Create the task.
     *
     * @return void
     */
    public function submit(): void
    {
        $this->validate();

        Task::create(['text' => $this->text]);

        $this->text = '';

        $this->emit('task-added');
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.create-task');
    }
}
