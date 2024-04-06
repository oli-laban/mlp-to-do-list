<div x-data="{ showCompleteModal: false, showDeleteModal: false }">
    <div class="card task-list">
        @if ($tasks->count())
            <table>
                <thead>
                    <th>#</th>
                    <th colspan="2">Task</th>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td class="task-list__text {{ $task->complete ? 'task-list__text--complete' : '' }}">{{ $task->text }}</td>
                            <td class="task-list__buttons">
                                @if (!$task->complete)
                                    <x-button type="button" color="green" class="task-list__button" @click="$wire.set('completing', {{ $task->id }}); showCompleteModal = true;">
                                        <svg class="task-list__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 -8 72 72" aria-labelledby="complete-task-{{ $loop->index + 1 }}">
                                            <title id="complete-task-{{ $loop->index + 1 }}">Complete task</title>
                                            <path d="M61.07,12.9,57,8.84a2.93,2.93,0,0,0-4.21,0L28.91,32.73,19.2,23A3,3,0,0,0,15,23l-4.06,4.07a2.93,2.93,0,0,0,0,4.21L26.81,47.16a2.84,2.84,0,0,0,2.1.89A2.87,2.87,0,0,0,31,47.16l30.05-30a2.93,2.93,0,0,0,0-4.21Z"/>
                                        </svg>
                                    </x-button>
                                    <x-button type="button" color="red" class="task-list__button" @click="$wire.set('deleting', {{ $task->id }}); showDeleteModal = true;">
                                        <svg class="task-list__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 -8 72 72" aria-labelledby="remove-task-{{ $loop->index + 1 }}">
                                            <title id="remove-task-{{ $loop->index + 1 }}">Remove task</title>
                                            <path d="M43.74,28,59,12.75a3.29,3.29,0,0,0,0-4.66L55.9,5a3.32,3.32,0,0,0-4.67,0L36,20.26,20.77,5.07a3.32,3.32,0,0,0-4.67,0L13,8.18a3.3,3.3,0,0,0,0,4.67L28.18,28,13,43.21a3.31,3.31,0,0,0,0,4.66L16.11,51a3.32,3.32,0,0,0,4.67,0L36,35.82,51.16,51a3.32,3.32,0,0,0,4.67,0l3.11-3.12a3.29,3.29,0,0,0,0-4.66Z"/>
                                        </svg>
                                    </x-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="task-list__message">
                You haven't added any tasks!
            </div>
        @endif
    </div>

    <x-modal key="showCompleteModal">
        <strong>Are you sure you wish to mark the task as complete?</strong>

        <x-slot:buttons>
            <x-button color="gray" @click="showCompleteModal = false">Cancel</x-button>
            <x-button color="green" wire:click="completeTask" @click="showCompleteModal = false">Mark Complete</x-button>
        </x-slot:buttons>
    </x-modal>

    <x-modal key="showDeleteModal">
        <strong>Are you sure you wish to delete the task?</strong>

        <x-slot:buttons>
            <x-button color="gray" @click="showDeleteModal = false">Cancel</x-button>
            <x-button color="red" wire:click="deleteTask" @click="showDeleteModal = false">Delete</x-button>
        </x-slot:buttons>
    </x-modal>
</div>
