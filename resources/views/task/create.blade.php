@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task.add-new-title')}}</h1>
    {{ Form::model($task, ['url' => route('tasks.store'), 'class' => 'w-50']) }}
    @include('task.form')
    {{ Form::submit(__('task.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
