@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('label.edit-title')}}</h1>
    {{ Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('label.form')
    {{ Form::submit(__('label.edit'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
