@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('label.add-new-title')}}</h1>
    {{ Form::model($label, ['url' => route('labels.store'), 'class' => 'w-50']) }}
    @include('label.form')
    {{ Form::submit(__('label.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
