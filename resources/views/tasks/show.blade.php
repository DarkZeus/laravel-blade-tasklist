@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    @include ('components.navbar')

    <hr>

    <h3>{{ $task->name }} <small><a href="{{ route('tasks.edit', ['user' => auth()->user(), 'task' => $task->slug]) }}">Edit</a></small></h3>
    <ul>
        <li>
          @isset($task->description)
            {{ $task->description }}
          @else
            Description is not provided
          @endisset
        </li>
        <li>
            @if ($task->is_done())
            Status: Done ✅
          @else
            Status: In progress ❎
          @endif
        </li>
        <li>{{ $task->created_at->format('l jS \\of F Y h:i:s A') }}</li>
        <li><a href="{{ route('tasks.index') }}">Go back</a></li>
    </ul>
@endsection
