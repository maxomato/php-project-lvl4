<div class='form-group'>
    {{ Form::label('name', __('task.name')) }}
    {{ Form::text('name', null, ['class' => "form-control" . ($errors->has('name') ?' is-invalid' : '')]) }}

    @error('name')
        <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
   {{ Form::label('name', __('task.description')) }}
   {{ Form::textarea('description', null, ['class' => "form-control" . ($errors->has('description') ?' is-invalid' : '')]) }}

   @error('description')
        <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('name', __('task.status')) }}
    {{ Form::select('status_id', $statuses->mapWithKeys(function ($item) {
        return [$item->id => $item->name];
    }), null, ['class' => 'form-control'. ($errors->has('status_id') ?' is-invalid' : ''), 'placeholder' => 'Status']) }}

    @error('status_id')
        <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
   {{ Form::label('name', __('task.assigned_to')) }}
   {{ Form::select('assigned_to_id', $users->mapWithKeys(function($user) {
        return [$user->id => $user->name];
    }), null,  ['placeholder' => 'Assignee', 'class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('name', __('task.labels')) }}
    {{ Form::select('labels[]', $labels->mapWithKeys(function($label) {
        return [$label->id => $label->name];
    }), null, ['class' => 'form-control', 'multiple' => true]) }}
</div>

