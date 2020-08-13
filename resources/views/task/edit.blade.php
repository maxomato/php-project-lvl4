@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task.edit-title')}}</h1>
    {{ Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('task.form')
    {{ Form::submit(__('task.edit'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
