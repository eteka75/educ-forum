<div>
    <h5 class="m0 psanel-heading"><i class="fa fa-yelp text-success"></i> Questions à suivre</h5>
    <div class="panelpanel-default">
        <div class="panel-body__">
            <ul class="list-unstyled post-list-right mtop10">
                @if(isset($posts_right))
                @foreach($posts_right as $rpost)

                <li><a href="{{ url(config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $rpost->category->slug . '/' . $rpost->slug) }}"><span style="color: #{{\App\Helpers\DataHelper::stringToColorCode(substr($rpost->title,15))}}" class="fa  fa-angle-double-right"></span> &nbsp;{{$rpost->title}}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>