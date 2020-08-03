@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task_status.add-new-title')}}</h1>
    {{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
    @include('taskStatus.form')
    {{ Form::submit(__('task_status.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
