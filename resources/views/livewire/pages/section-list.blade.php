<div>
    <div class="otchet__wrap">
        @foreach($level_one_categories as $category)
            <a href="{{ url(URL::current().'/'.$category->slug) }}"><i class="fas fa-folder"></i><span>{{ $category->name }}</span> </a>
        @endforeach
    </div>
</div>
