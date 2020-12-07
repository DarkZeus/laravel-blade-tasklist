<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Display a listing of tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = auth()->user()->tasks->sortByDesc('created_at');

        return view('tasks.index')->withTasks($tasks);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name . '-' . Str::random(4)),
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified task.
     *
     * @param User $user
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Task $task)
    {
        return view('tasks.show')->withTask($task);
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Task $task)
    {
        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param App\Models\User $user
     * @param \App\Models\Task $task
     * @return void
     */
    public function update(TaskRequest $request, User $user, Task $task)
    {
        $task->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.show', ['user' => $user->slug, 'task' => $task->slug]);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function check(Request $request, User $user, Task $task)
    {
        $task->update([
            'is_done' => !$task->is_done,
        ]);

        return redirect()->route('tasks.index');
    }
}
