<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
   <!-- {!! Form::label('title', 'Title', ['class' => 'col-md-12']) !!}-->
    <div class="col-md-8 pad0">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4 pad0">
        {!! Form::select('categorie', [1=>'technology', 2=>'tips',3=> 'health'], null, ['class' => 'form-control categ-inline']) !!}
        {!! $errors->first('categorie', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!--div class="form-group {{ $errors->has('categorie') ? 'has-error' : ''}}">
   <!-- {!! Form::label('categorie', 'Categorie', ['class' => 'col-md-4 control-label']) !!}->
    
</div-->

<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
    <!--{!! Form::label('body', 'Body', ['class' => 'col-md-4 control-label']) !!}-->
    <div class="col-md-12 pad0"><br>
        {!! Form::textarea('body', null, ['class' => 'form-control','rows'=>3]) !!}
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>

</div>


<div class="form-group "><br>
    <div class="col-md-offset-0 col-md-12 pad0 text-right"><br>
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
