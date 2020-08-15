@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task.title')}}</h1>
    <div class="d-flex">
        <div>
            {{ Form::open(['url' => route('tasks.index'), 'method' => 'GET', 'class' => 'form-inline']) }}
                {{ Form::select('filter[status_id]', $statuses->mapWithKeys(function ($item) {
                        return [$item->id => $item->name];
                    }), $filter, ['class' => 'form-control mr-2', 'placeholder' => 'Status'])  }}
                 {{ Form::select('filter[created_by_id]', $users->mapWithKeys(function ($item) {
                        return [$item->id => $item->name];
                    }), $filter, ['class' => 'form-control mr-2', 'placeholder' => 'Creator'])  }}
                {{ Form::select('filter[assigned_to_id]', $users->mapWithKeys(function ($item) {
                        return [$item->id => $item->name];
                    }), $filter, ['class' => 'form-control mr-2', 'placeholder' => 'Assignee'])  }}
                {{ Form::submit(__('task.apply'), ['class' => 'btn btn-outline-primary mr-2']) }}
            {{ Form::close() }}
        </div>

        @if (Auth::check())
            <a href="{{ route('tasks.create') }}" class='btn btn-primary ml-auto'>
                {{__('task.add-new')}}
            </a>
        @endif
    </div>

    <table class="table mt-2">
        <tr>
            <th>{{__('task.id')}}</th>
            <th>{{__('task.status')}}</th>
            <th>{{__('task.name')}}</th>
            <th>{{__('task.creator')}}</th>
            <th>{{__('task.assignee')}}</th>
            <th>{{__('task.created-at')}}</th>
            @if (Auth::check())
                <th>{{__('task.actions')}}</th>
            @endif
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                <td>{{ $task->createdBy->name }}</td>
                <td>{{ $task->assignedTo->name ?? '' }}</td>
                <td>{{ date('M d Y', strtotime($task->created_at)) }}</td>
                @if (Auth::check())
                    <td>
                        @if (Auth::user()->id === $task->createdBy->id)
                            <a href="{{ route('tasks.destroy', $task) }}"
                               data-confirm="{{__('task.confirm-question')}}" data-method="delete" rel="nofollow">
                                {{__('task.remove')}}
                            </a>
                        @endif
                        <a href="{{ route('tasks.edit', $task) }}">{{__('task.edit')}}</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>

    {{ $tasks->links() }}
@endsection
