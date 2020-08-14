<div class='form-group'>
    {{ Form::label('name', __('label.name')) }}
    {{ Form::text('name', null, ['class' => "form-control" . ($errors->has('name') ?' is-invalid' : '')]) }}

    @error('name')
        <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>

