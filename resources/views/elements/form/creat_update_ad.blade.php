{{ Form::open() }}
<div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', isset($ad->title) ? $ad->title : null, ['class' => 'form-control']) }}
    <span class="title_error"></span>
</div>
<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', isset($ad->description) ? $ad->description : null, ['class' => 'form-control']) }}
    <span class="description_error"></span>
</div>
<div class="form-group">
    {{ Form::button(isset($ad) ? 'Save' : 'Create', ['id' => 'save', 'class' => 'btn btn-success']) }}
</div>
{{ Form::close() }}