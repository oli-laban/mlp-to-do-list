<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TaskList extends Component
{
    /**
     * Indicates which task is being completed by the modal.
     *
     * @var int|null
     */
    public ?int $completing = null;

    /**
     * Indicates which task is being deleted by the modal.
     *
     * @var int|null
     */
    public ?int $deleting = null;

    /**
     * The component's validation rules.
     *
     * @var array
     */
    public array $rules = [
        'completing' => 'required|int|exists:tasks,id',
        'deleting' => 'required|int|exists:tasks,id',
    ];

    /**
     * The component's event listeners.
     *
     * @var array
     */
    public $listeners = [
        'task-added' => '$refresh',
    ];

    /**
     * Mark the $completing task as complete.
     *
     * @return void
     */
    public function completeTask(): void
    {
        $this->validateOnly('completing');

        Task::where('id', $this->completing)->update(['complete' => true]);
    }

    /**
     * Delete the $deleting task.
     *
     * @return void
     */
    public function deleteTask(): void
    {
        $this->validateOnly('deleting');

        Task::where('id', $this->deleting)->delete();
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        $tasks = Task::orderBy('id')->get();

        return view('livewire.task-list', compact('tasks'));
    }
}
