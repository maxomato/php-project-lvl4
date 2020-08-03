@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task_status.title')}}</h1>
    @if (Auth::check())
        <a href="{{ route('task_statuses.create') }}" class='btn btn-primary'>
            {{__('task_status.add-new')}}
        </a>
    @endif

    <table class="table mt-2">
        <tr>
            <th>{{__('task_status.id')}}</th>
            <th>{{__('task_status.name')}}</th>
            <th>{{__('task_status.created-at')}}</th>
            @if (Auth::check())
                <th>{{__('task_status.actions')}}</th>
            @endif
        </tr>
        @foreach ($taskStatuses as $taskStatus)
            <tr>
                <td>{{ $taskStatus->id }}</td>
                <td>{{ $taskStatus->name }}</td>
                <td>{{ date('M d Y') }}</td>
                @if (Auth::check())
                    <td>
                        <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                           data-confirm="{{__('task_status.confirm-question')}}" data-method="delete" rel="nofollow">
                            {{__('task_status.remove')}}
                        </a>
                        <a href="{{ route('task_statuses.edit', $taskStatus) }}">{{__('task_status.edit')}}</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
@endsection
