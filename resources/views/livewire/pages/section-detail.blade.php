<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class=""><a href="{{ route('index') }}">Главная</a></li>
            <li class=""><a href="{{ route($pageRoute) }}">{{ $pageTitle }}</a></li>
            @foreach ($parentCategories as $category)
                <li><a href="{{ route($sectionPageRouteName, ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
            @endforeach
            <li class="">{{ $section->name }}</li>
        </ol>
    </nav>
    <div class="title">{{ $sectionName }}</div>
    @if($next_level_categories)
        <div class="otchet__wrap">
            @foreach($next_level_categories as $category)
                <a href="{{ $category->slug }}"><i class="fas fa-folder"></i><span>{{ $category->name }}</span> </a>
            @endforeach
        </div>
    @elseif($elements->count())
        <div class="news__wrap">
            @foreach($elements as $element)
                <div class="news__item">
                    <a href="{{ route($detailPageRouteName, ['slug' => $element->slug]) }}" class="news__t">{{ $element->title }}</a>
                    <p>{{ mb_substr(strip_tags($element->lastRedaction()?->description), 0, 371) . '...' }}</p>
                </div>
            @endforeach
        </div>
        @include('livewire.components.pagination', ['elements' => $elements])
    @else
        <div class="otchet__wrap">
            Раздел пуст.
        </div>
    @endif
</div>
