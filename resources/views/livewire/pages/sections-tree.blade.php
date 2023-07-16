<div>
    <div class="otchet-d__wrap">
        <div class="otchet-d__left">
            <div class="otchet__tree2" wire:ignore>
                {!! $sectionsHtml !!}
            </div>
        </div>
        @if($showDetailPage)
            <div class="otchet__item is-active">
                @if($hasAccess)
                    <div class="norm-d">
                        <div class="js-tabs js-tabs-d">
                            <div class="row">
                                <div class="col-md-7">
                                    <ul class="js-tabs__header tabs__list">
                                        <li class="tab tab-1 @if(!$openedTab) is-active @endif" onclick="tabClick(this)">Текст</li>
                                        <li class="tab tab-2" onclick="tabClick(this)">Оглавление</li>
                                        <li class="tab tab-3" onclick="tabClick(this)">Приложения</li>
                                        <li class="tab tab-4 @if($openedTab == 'connections') is-active @endif" onclick="tabClick(this)">Связи</li>
                                    </ul>
                                </div>
                                @if($redactions)
                                    <div class="col-md-5">
                                        <div class="norm-select">
                                            <div class="norm-select__top">
                                                <span>
                                                    @if(strtotime(date('Y-m-d')) < strtotime($date))
                                                        Вступит в дейстиве
                                                    @else
                                                        В действии с
                                                    @endif
                                                </span>
                                                <span class="norm-select-data">{{ $date }}</span>
                                            </div>

                                            <div class="norm-select__bot">
                                                <span>Выбор оглавления</span>
                                                <ul>
                                                    @foreach($redactions as $redaction)
                                                        <li wire:click.prevent="changeRedaction({{ $redaction['id'] }})" class="redaction-li" data-redaction="{{ $redaction['id'] }}">{{ $redaction->getDate() }}</li>
                                                    @endforeach
                                                </ul>
                                                <div class="polzunok-input">
                                                    <input id="polzunok" type="checkbox" wire:model="changes">
                                                    <label for="polzunok">
                                                        Показать изменения
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="otchet__name2">{{ $detail->title }}</div>
                            <div class="tabs__container">
                                <div class="js-tabs__content js-tabs__content-1 @if(!$openedTab) is-active @endif">
                                    {!! $description !!}

                                    @auth()
                                        <div class="js-tabs__content__bar">
                                            <button type="button" class="tabs__content__bar__btn @if($favorite) active @endif" wire:click.prevent="favorites()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                                     viewBox="0 0 20 20" fill="none">
                                                    <path fill="#000000" fill-rule="evenodd"
                                                          d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z" />
                                                </svg>
                                                <div class="tabs__content__bar__tooltip">
                                                    @if($favorite)
                                                        Убрать из избранного
                                                    @else
                                                        Добавить в избраное
                                                    @endif
                                                </div>
                                            </button>
                                        </div>
                                    @endauth
                                </div>
                                <div class="js-tabs__content js-tabs__content-2">
                                    <ul class="norm-list">
                                        @if($titles && !($titles->isEmpty()))
                                            @foreach($titles as $title)
                                                <li>
                                                    <a href="#" type="button" onclick="goToTitle('{{ $title['text_id'] }}')">
                                                        {{ $title['title'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            Оглавление пусто.
                                        @endif
                                    </ul>
                                </div>
                                <div class="js-tabs__content js-tabs__content-3">
                                    <ul class="norm-list">
                                        @if($files?->count())
                                            @foreach($files as $file)
                                                <li>
                                                    <a href="javascript:;" type="button" class="doc-text" data-bs-toggle="modal" data-bs-target="#fileModal{{ $file->id }}">
                                                        {{ $file->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            Список файлов пуст.
                                        @endif
                                    </ul>
                                </div>
                                <div class="js-tabs__content js-tabs__content-4 @if($openedTab == 'connections') is-active @endif">
                                    <div class="tags">
                                        <span>Статьи отобратные по тегам:</span>
                                        <ul>
                                            @if(!($tags?->isEmpty()))
                                                @foreach($tags as $tag)
                                                    @if(in_array($tag['id'], $tagsIds))
                                                        <li><a href="#" wire:click.prevent="removeTag({{ $tag['id'] }})" style="font-weight: bold;">{{ $tag->name }} &#10008;</a></li>
                                                    @else
                                                        <li><a href="#" wire:click.prevent="addTag({{ $tag['id'] }})">{{ $tag->name }}</a></li>
                                                    @endif
                                                @endforeach

                                                <li><a href="#" wire:click.prevent="setAllTags()">Выбрать все</a></li>
                                                <li><a href="#" wire:click.prevent="removeAllTags()">Отменить все</a></li>
                                            @else
                                                Список тегов пуст.
                                            @endif
                                        </ul>
                                    </div>
                                    @if($news)
                                        @if($news->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('news')">Новости</div>
                                                <div class="spoiler-body" @if(in_array('news', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($news as $eachNews)
                                                            <li>
                                                                <a href="{{ route('news.show', ['slug' => $eachNews->slug]) }}" target="_blank">{{ $eachNews->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($handbooks)
                                        @if($handbooks->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('handbooks')">Справочники</div>
                                                <div class="spoiler-body" @if(in_array('handbooks', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($handbooks as $eachHandbook)
                                                            <li>
                                                                <a href="{{ route('handbookDetail', ['slug' => $eachHandbook->slug]) }}" target="_blank">{{ $eachHandbook->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($taxSystems)
                                        @if($taxSystems->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('tax-systems')">Налоговая система</div>
                                                <div class="spoiler-body" @if(in_array('tax-systems', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($taxSystems as $eachTaxSystem)
                                                            <li>
                                                                <a href="{{ route('taxSystem', ['section' => $eachTaxSystem->category_id, 'element' => $eachTaxSystem->id]) }}" target="_blank">{{ $eachTaxSystem->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($reports)
                                        @if($reports->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('reports')">Отчетность</div>
                                                <div class="spoiler-body" @if(in_array('reports', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($reports as $report)
                                                            <li>
                                                                <a href="{{ route('reports', ['section' => $report->category_id, 'element' => $report->id]) }}" target="_blank">{{ $report->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($blanks)
                                        @if($blanks->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('blanks')">Формы и бланки</div>
                                                <div class="spoiler-body" @if(in_array('blanks', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($blanks as $blank)
                                                            <li>
                                                                <a href="{{ route('blanks', ['section' => $blank->category_id, 'element' => $blank->id]) }}" target="_blank">{{ $blank->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($consultations)
                                        @if($consultations->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('consultations')">Консультации и аналитика</div>
                                                <div class="spoiler-body" @if(in_array('consultations', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($consultations as $consultation)
                                                            <li>
                                                                <a href="{{ route('consultations', ['section' => $consultation->category_id, 'element' => $consultation->id]) }}" target="_blank">{{ $consultation->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($norms)
                                        @if($norms->count())
                                            <div class="spoiler-wrap">
                                                <div class="spoiler-head" wire:click.prevent="openSpoiler('norms')">Нормативная база</div>
                                                <div class="spoiler-body" @if(in_array('norms', $activeSpoilers)) style="display: block;" @endif>
                                                    <ul class="norm-list">
                                                        @foreach($norms as $norm)
                                                            <li>
                                                                <a href="{{ route('normativeBaseDetail', ['slug' => $norm->slug]) }}" target="_blank">{{ $norm->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($files?->count())
                        @foreach($files as $file)
                            <div class="modal fade" id="fileModal{{ $file->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-fix-close" data-bs-dismiss="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"></path></svg>
                                        </div>
                                        <iframe class="doc-iframe" src="{{ env('APP_URL') . '/storage/' . json_decode($file->file_url)[0]->download_link }}"></iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else
                    <div class="norm-d">
                        <div class="otchet__name2">{{ $detail->title }}</div>
                        <div class="tabs__container">
                            <div class="js-tabs__content is-active">
                                {{ __('detail.no_access') }}
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        @endif
    </div>
    @if(!$changes)
        <style>
            .comment {
                display:none;
            }
        </style>
    @endif
</div>

<script>
    // Функция-обработчик клика на таб
    function tabClick(tab) {
        var tabs = document.querySelectorAll('.tab');
        tabs.forEach(function(tab) {
            tab.classList.remove('is-active');
        });

        tab.classList.add('is-active');
        var tabIndex = tab.classList[1].split('-')[1];
        var contents = document.querySelectorAll('.js-tabs__content');

        contents.forEach(function(content) {
            content.classList.remove('is-active');
            if (content.classList.contains('js-tabs__content-' + tabIndex)) {
                content.classList.add('is-active');
            }
        });
    }

    function goToTitle(titleId) {
        var activeTabButton = document.getElementsByClassName('tab')[1];
        var firstTabButton = document.getElementsByClassName('tab')[0];
        var activeTab = document.getElementsByClassName('js-tabs__content')[1];
        var firstTab = document.getElementsByClassName('js-tabs__content')[0];

        activeTabButton.classList.remove('is-active');
        firstTabButton.classList.add('is-active');
        activeTab.classList.remove('is-active');
        firstTab.classList.add('is-active');

        window.scrollTo(0, document.getElementById(titleId).offsetTop - 0);
    }

    // Добавление id раздела в url
    const divElements = document.querySelectorAll('.tree__for');
    divElements.forEach(divElement => {
        divElement.addEventListener('click', () => {
            const url = new URL(window.location.href);
            url.searchParams.set('section', divElement.getAttribute('data-for'));
            window.history.pushState(null, null, url.toString());
        });
    });

    // Добавление id элемента в url
    const divModelElements = document.querySelectorAll('.element__for');
    divModelElements.forEach(divElement => {
        divElement.addEventListener('click', () => {
            const url = new URL(window.location.href);
            url.searchParams.set('element', divElement.getAttribute('data-for'));
            url.searchParams.delete('redaction');
            window.history.pushState(null, null, url.toString());
        });
    });

    // Селект выбора редакции
    var normSelect = document.querySelector('.norm-select');
    if (normSelect) {
        normSelect.onclick = function() {
            if (this.classList.contains('active')) {
                this.classList.remove('active');
            } else {
                this.classList.add('active');
            }
        };
    }

    // Активный элемент в меню
    const elementsTree = document.querySelectorAll('.element__for');
    elementsTree.forEach(element => {
        element.addEventListener('click', () => {
            elementsTree.forEach(el => el.classList.remove('active'));
            element.classList.add('active');
        });
    });

    document.addEventListener('livewire:update', function () {
        // Селект выбора редакции
        var normSelect = document.querySelector('.norm-select');
        normSelect.onclick = function() {
            if (this.classList.contains('active')) {
                this.classList.remove('active');
            } else {
                this.classList.add('active');
            }
        };

        // Добавление id редакции в url
        const elements = document.querySelectorAll('.redaction-li');
        elements.forEach(element => {
            element.addEventListener('click', () => {
                const url = new URL(window.location.href);
                url.searchParams.set('redaction', element.getAttribute('data-redaction'));
                window.history.pushState(null, null, url.toString());
            });
        });

        // Добавление id раздела в url
        const divElements = document.querySelectorAll('.tree__for');
        divElements.forEach(divElement => {
            divElement.addEventListener('click', () => {
                const url = new URL(window.location.href);
                url.searchParams.set('section', divElement.getAttribute('data-for'));
                window.history.pushState(null, null, url.toString());
            });
        });

        // Добавление id элемента в url
        const divModelElements = document.querySelectorAll('.element__for');
        divModelElements.forEach(divElement => {
            divElement.addEventListener('click', () => {
                const url = new URL(window.location.href);
                url.searchParams.set('element', divElement.getAttribute('data-for'));
                url.searchParams.delete('redaction');
                window.history.pushState(null, null, url.toString());
            });
        });

        // Активный элемент в дереве разделов
        const elementsTree = document.querySelectorAll('.element__for');
        elementsTree.forEach(element => {
            element.addEventListener('click', () => {
                elementsTree.forEach(el => el.classList.remove('active'));
                element.classList.add('active');
            });
        });
    })
</script>
