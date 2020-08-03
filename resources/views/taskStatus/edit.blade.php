@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task_status.edit-title')}}</h1>
    {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('taskStatus.form')
    {{ Form::submit(__('task_status.edit'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
