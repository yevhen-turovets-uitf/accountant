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
    @if($next_level_categories)
        <div class="profile content-wrap">
            <div class="title">{{ $sectionName }}</div>
            <div class="otchet__wrap">
                @foreach($next_level_categories as $category)
                    <a href="{{ $category->slug }}"><i class="fas fa-folder"></i><span>{{ $category->name }}</span> </a>
                @endforeach
            </div>
        </div>
    @elseif($elements->count())
        <div class="title calendar__top2">{{ $sectionName }}</div>

        <div class="ukaz__wrap">
            <div class="table">
                <div class="thead">

                    <div>Наименование</div>
                    <div class="filter-thead">Номер
                        <span class="filter-icon">
                            <i class="fas fa-sort-amount-up-alt"></i>
                            <i class="fas fa-sort-amount-down"></i>
                        </span>
                    </div>
                    <div class="filter-thead">ДАТА
                        <span class="filter-icon">
                            <i class="fas fa-sort-amount-up-alt"></i>
                            <i class="fas fa-sort-amount-down"></i>
                        </span>
                    </div>
                    <div class="filter-thead">Статус
                        <span class="filter-icon">
                            <i class="fas fa-sort-amount-up-alt"></i>
                            <i class="fas fa-sort-amount-down"></i>
                        </span>
                    </div>
                    <div class="filter-thead">Дата опубликования
                        <span class="filter-icon">
                            <i class="fas fa-sort-amount-up-alt"></i>
                            <i class="fas fa-sort-amount-down"></i>
                        </span>
                    </div>
                </div>
                <div class="tbody">
                    @foreach($elements as $element)
                        <a href="{{ route($detailPageRouteName, ['slug' => $element->slug]) }}" class="tr">
                            <div class="ukaz_text-td">
                                <div class="ukaz__title">{{ $element->title }}</div>
                                <div class="ukaz__text">
                                    {{ mb_substr(strip_tags($element->lastRedaction()?->description), 0, 371) . '...' }}
                                </div>
                            </div>
                            <div>
                                {{ $element->number }}
                            </div>
                            <div>
                                {{ $element->date->format('d.m.Y') }}
                            </div>
                            <div>
                                <div class="status">
                                    <span style="background-color: #167bc1;"></span> {{ __('statuses.' . $element->status) }}
                                </div>
                            </div>
                            <div>
                                {{ $element->created_at->format('d.m.Y') }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @include('livewire.components.pagination', ['elements' => $elements])
    @else
        <div class="otchet__wrap">
            Раздел пуст.
        </div>
    @endif

</div>
