@extends('layouts.app')

@section('content')
    <h1 class='mb-5'>{{__('label.title')}}</h1>
    @if (Auth::check())
        <a href="{{ route('labels.create') }}" class='btn btn-primary'>
            {{__('label.add-new')}}
        </a>
    @endif

    <table class="table mt-2">
        <tr>
            <th>{{__('label.id')}}</th>
            <th>{{__('label.name')}}</th>
            <th>{{__('label.created-at')}}</th>
            @if (Auth::check())
                <th>{{__('label.actions')}}</th>
            @endif
        </tr>
        @foreach ($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ date('M d Y', strtotime($label->created_at)) }}</td>
                @if (Auth::check())
                    <td>
                        <a href="{{ route('labels.destroy', $label) }}"
                           data-confirm="{{__('label.confirm-question')}}" data-method="delete" rel="nofollow">
                            {{__('label.remove')}}
                        </a>
                        <a href="{{ route('labels.edit', $label) }}">{{__('label.edit')}}</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
@endsection
