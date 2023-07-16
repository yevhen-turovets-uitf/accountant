<div class="index-page">
    @if(count($slides))
        <div class="index-slider glide">
            <div class="glide__track" data-glide-el="track">
                <div class="glide__slides">
                    @foreach($slides as $slide)
                        <div class="slider-top__item">
                            <div class="slider-top__title">{{ $slide['title'] }}</div>
                            <p>{!! $slide['description'] !!}</p>
                            @if($slide['link'])
                                <a href="{{ $slide['link'] }}" class="btn btn-primary">Подробнее</a>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="glide__bullets" data-glide-el="controls[nav]">
                @for($i = 0; $i < count($slides); $i++)
                    <button class="glide__bullet" data-glide-dir="={{ $i }}"></button>
                @endfor
            </div>
        </div>
    @endif

    <div class="dostup">
        <div class="row">
            <div class="col-xl-6">
                <div class="dostup__wrap">
                    <span>Получите открытый доступ: </span>
                    <div>
                        <a href="{{ route('help') }}">Тестовый период</a>
                        <a href="{{ route('help') }}">По договору</a>
                    </div>

                </div>
            </div>
            <div class="col-xl-6">
                <form class="search" action="{{ route('search') }}">
                    <input type="text" name="search" placeholder="Поиск">
                    <button class="btn btn-primary">Искать</button>
                </form>
            </div>
        </div>
    </div>
    <div class="centerrow">
        <div class="row">
            <div class="col-xl-6">
                @if(count($news))
                    <div class="newsblock">
                        <div class="blocktitle">Новое в законодательстве</div>
                        <div class="newsblock__wrap">
                            @foreach($news as $eachNews)
                                <div class="newsitem">
                                    <div class="newsitem__data">{{ $eachNews['createdDate'] }}</div>
                                    <a href="{{ route('news.show', ['slug' => $eachNews['slug']]) }}">{{ $eachNews['title'] }}</a>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('news.list') }}" class="white-btn">Больше новостей</a>
                    </div>
                @endif
            </div>
            <div class="col-xl-6">
                <div class="calendar">
                    <div class="blocktitle">Календарь бухгалтера</div>
                    <div class="calendar__wrap">
                        <div class="calendar__data">{{ __('calendar.months_full.' . date('n')) . ' ' . date('Y') }}</div>
                        <div class="calendar__slider">
                            <div class="glide__track" data-glide-el="track">
                                <div class="glide__slides">
                                    @foreach($calendarDates as $calendarDate)
                                        <a class="calendar__item" href="{{ route('accountantCalendar', ['d' => $calendarDate['day'], 'm' => $calendarDate['month'],  'y' => $calendarDate['year']]) }}" tabindex="0">
                                            {{ $calendarDate['weekday'] }}
                                            <span class="calendar-item__day">{{ $calendarDate['day'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
                                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
                            </div>
                        </div>
                        <a href="{{ route('accountantCalendar') }}" class="calendar__link">Календарь рабочего времени</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($usefulLinks))
        <div class="pollink">
            <div class="blocktitle">Полезные ссылки</div>
            <div class="pollink__wrap">
                @foreach($usefulLinks as $usefulLink)
                    <a href="{{ $usefulLink['url'] }}">{{ $usefulLink['title'] }}</a>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($published))
        <div class="morenews">
            <div class="blocktitle">Опубликовано на сайте</div>
            <div class="morenews__wrap">
                @foreach($published as $eachPublished)
                    <div class="newsitem">
                        <div class="newsitem__data">{{ $eachPublished['date'] }}</div>
                        <a href="{{ $eachPublished['url'] }}">{{ $eachPublished['title'] }}</a>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('publishedOnSite') }}" class="white-btn">Больше публикаций</a>
        </div>
    @endif
</div>
