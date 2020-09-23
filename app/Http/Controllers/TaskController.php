<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Arr;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            ])
            ->get();
        $users = User::all();
        $statuses = TaskStatus::all();

        return view('task.index', compact('filter', 'tasks', 'users', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        $data = $request->validated();

        $task = new Task();
        $task->fill($data);
        $task->createdBy()->associate(auth()->user());
        $task->save();

        $labelIds = Arr::get($data, 'labels', []);
        $task->labels()->attach($labelIds);

        return redirect()->route('tasks.index')
                         ->with('message', 'flash.task.store.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('task.view', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, Task $task)
    {
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        $labelIds = Arr::get($data, 'labels', []);
        $task->labels()->sync($labelIds);

        return redirect()->route('tasks.index')
                         ->with('message', 'flash.task.update.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->labels()->detach();
        $task->delete();
        return redirect()->route('tasks.index')
                         ->with('message', 'flash.task.remove.success');
    }
}
