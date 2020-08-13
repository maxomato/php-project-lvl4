@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('task.show-title')}}: {{ $task->name }}</h1>
    {{__('task.show-name')}}: {{ $task->name }}
@endsection
