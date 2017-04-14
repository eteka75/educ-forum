
<div class="form-group  {{ $errors->has('title') ? 'has-error' : ''}}">
    <!-- {!! Form::label('title', 'Title', ['class' => 'col-md-12']) !!}-->


    {!! Form::text('title', null, ['class' => 'form-control pad0_15','autocomplete'=>'off','placeholder'=>"Ecrivez ici le problème encontré "]) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}

</div>
<div class="form-group  {{ $errors->has('categorie') ? 'has-error' : ''}}">

    {!! Form::select('categorie', $s_categories, null, ['class' => 'form-control ']) !!}
    {!! $errors->first('categorie', '<p class="help-block">:message</p>') !!}

</div>
<!--div class="form-group {{ $errors->has('categorie') ? 'has-error' : ''}}">
<!-- {!! Form::label('categorie', 'Categorie', ['class' => 'col-md-4 control-label']) !!}->
 
</div-->

<div class="form-group  {{ $errors->has('body') ? 'has-error' : ''}}">

    {!! Form::textarea('body', null, ['class' => 'form-control','rows'=>3]) !!}
    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}

</div>
<div class="">
    <div class="row">
        <div class="col-xs-8 col-md-9">
            <ul class="list-inline" style="font-size: 18px">
                    <li><a class="text-muted" href="#"><i class="glyphicon glyphicon-picture"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="glyphicon glyphicon-pushpin"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="glyphicon glyphicon-star "></i></a></li>
            </ul>
        </div>
        <div class="col-xs-4 col-md-3">
            <button type="submit" class="btn btn-primary center-block" >Soumettre </button>
            <!--<button class="btn btn-primarys pull-right btn-xss" type="button">Diffuser</button>-->
        </div>
    </div>
</div>


