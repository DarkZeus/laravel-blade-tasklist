@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    @include ('components.navbar')

    <hr>

    <h3>Create new task <small><a href="{{ route('tasks.index') }}">Go back</a></small></h3>
    <div>
        @if ($errors->any())
          <div>
              <div>{{ __('Whoops! Something went wrong.') }}</div>

              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form method="POST" action="{{ route('tasks.update', ['user' => auth()->user(), 'task' => $task]) }}">
        @csrf
        @method('PUT')
        <div>
            <label>{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $task->name }}" required autofocus autocomplete="name" />
        </div>

        <div>
          <label>{{ __('Description') }}</label>
          <textarea name="description" rows="5" cols="25">{{ $task->description }}</textarea>
        </div>

        <div>
            <button type="submit">
                {{ __('Create') }}
            </button>
        </div>
      </form>

    </div>
@endsection
