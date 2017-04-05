<div class="form-group {{ $errors->has('categorie_id') ? 'has-error' : ''}}">
    {!! Form::label('categorie_id', trans('discussions.categorie_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('categorie_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('categorie_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', trans('discussions.user_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', trans('discussions.title'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sticky') ? 'has-error' : ''}}">
    {!! Form::label('sticky', trans('discussions.sticky'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('sticky', ['0', '1'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('sticky', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('views') ? 'has-error' : ''}}">
    {!! Form::label('views', trans('discussions.views'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('views', null, ['class' => 'form-control']) !!}
        {!! $errors->first('views', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('answered') ? 'has-error' : ''}}">
    {!! Form::label('answered', trans('discussions.answered'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('answered', ['0', '1'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('answered', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug', trans('discussions.slug'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
    {!! Form::label('color', trans('discussions.color'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('color', null, ['class' => 'form-control']) !!}
        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
