@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    @include ('components.navbar')

    <hr>

    <a href="{{ route('tasks.create') }}">Add new task</a>

    <ul>
      @foreach ($tasks as $task)
          <li>
            <a href="{{ route('tasks.show', ['user' => auth()->user()->slug,'task' => $task->slug]) }}">
              @if ($task->is_done)
                <strike>
                  <form id="task-check-form-{{ $task->slug }}" action="{{ route('tasks.check', ['user' => auth()->user(), 'task' => $task]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                  </form>
                  <form id="task-destroy-form-{{ $task->slug }}" action="{{ route('tasks.destroy', ['user' => auth()->user(), 'task' => $task]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                  </form>
                  <input type="checkbox"
                         checked
                         name="is_done"
                        onclick="event.preventDefault(); document.getElementById('task-check-form-{{ $task->slug }}').submit();">
                  {{ $task->name }}
                </strike>
                <a style="margin-left: 10px;" href="#"
                      onclick="event.preventDefault(); document.getElementById('task-destroy-form-{{ $task->slug }}').submit();">❌</a>
              @else
                <form id="task-check-form-{{ $task->slug }}" action="{{ route('tasks.check', ['user' => auth()->user(), 'task' => $task]) }}" method="POST">
                  @csrf
                  @method('PATCH')
                </form>
                <input type="checkbox"
                       name="is_done"
                      onclick="event.preventDefault(); document.getElementById('task-check-form-{{ $task->slug }}').submit();">
                {{ $task->name }}
              @endif
            </a>
          </li>
      @endforeach
    </ul>
@endsection
