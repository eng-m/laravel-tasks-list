@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <nav class="mb-4 flex justify-between items-center">
        <a href="{{ route('tasks.create') }}" class="link">Add Task!</a>
        <div class="relative inline-block">
            <select name="sort" onchange="window.location.href = '{{ route('tasks.index') }}?sort=' + this.value"
                class="block appearance-none w-full bg-white border border-gray-300 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="">Sort By</option>
                <option value="pending" {{ request('sort') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ request('sort') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="created_date" {{ request('sort') === 'created_date' ? 'selected' : '' }}>Created Date
                </option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 12l-6-6 1.414-1.414L10 9.172l4.586-4.586L16 6l-6 6z" />
                </svg>
            </div>
        </div>

    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif

@endsection
