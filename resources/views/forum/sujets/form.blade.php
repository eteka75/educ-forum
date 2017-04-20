
<div class="form-group  {{ $errors->has('title') ? 'has-error' : ''}}">
    <!-- {!! Form::label('title', 'Title', ['class' => 'col-md-12']) !!}-->


    {!! Form::text('title', null, ['id'=>"edit_post",'class' => 'form-control pad0_15 input-special','autocomplete'=>'off','placeholder'=>"Ecrivez ici le problème encontré "]) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}

</div>
<div id="less_post" class="hidden">
    <div class="form-group  {{ $errors->has('categorie') ? 'has-error' : ''}}">

        {!! Form::select('categorie', $s_categories, null, ['class' => 'form-control input-special']) !!}
        {!! $errors->first('categorie', '<p class="help-block">:message</p>') !!}

    </div>
    <div class="form-group  {{ $errors->has('body') ? 'has-error' : ''}}">

        {!! Form::textarea('body', null, ['class' => 'form-control input-special','rows'=>3]) !!}
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}

    </div>
    <div class="">
        <div class="row">
            <div class="col-xs-7 col-md-9">
                <ul class="list-inline hidden" style="font-size: 18px">
                    <li><a class="text-muted" href="#"><i class="glyphicon glyphicon-picture"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="glyphicon glyphicon-pushpin"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="glyphicon glyphicon-star "></i></a></li>
                </ul>
            </div>
            <div class="col-xs-5 col-md-3">
                <button type="submit" class="btn btn-primary center-block rond3" >Soumettre </button>
                <!--<button class="btn btn-primarys pull-right btn-xss" type="button">Diffuser</button>-->
            </div>
        </div>
    </div>
</div>


