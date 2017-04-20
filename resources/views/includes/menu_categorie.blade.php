<div class="menu_gauche">
    <a id="new_discussion_btn" class="btn btn-primary" href="{{route('NewSujet')}}"><i class="fa  fa-comment"></i> Nouveau sujet</a> 
    <a href="{{ route('showAllCategory')}}"><b><i class=" fa-comments-o fa "></i> Toutes les catégories</a></b> 
<ul class="nav nav-pills nav-stacked">
    <?php if (isset($categories)) { ?>
        @foreach($categories as $category)
        <li class="<?= (isset($slug) && $slug != '' && $category->slug == $slug) ? "active" : NULL; ?>"><a href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }} <i class="fa fa-chevron-right mtop5 pull-right"></i></a></li>
        @endforeach
    <?php } ?>
</ul>
</div>