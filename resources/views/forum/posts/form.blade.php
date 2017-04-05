<div class="form-group {{ $errors->has('discussion_id') ? 'has-error' : ''}}">
    {!! Form::label('discussion_id', trans('posts.discussion_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('discussion_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('discussion_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', trans('posts.user_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
    {!! Form::label('body', trans('posts.body'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('markdown') ? 'has-error' : ''}}">
    {!! Form::label('markdown', trans('posts.markdown'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('markdown', ['0', '1'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('markdown', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('locked') ? 'has-error' : ''}}">
    {!! Form::label('locked', trans('posts.locked'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('locked', ['0', '1'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('locked', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
