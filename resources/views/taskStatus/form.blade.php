<div class='form-group'>
    {{ Form::label('name', __('task_status.name')) }}
    {{ Form::text('name', null, ['class' => "form-control" . ($errors->has('name') ?' is-invalid' : '')]) }}

    @error('name')
        <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>

