<div>
    @if($hasAccess)
        <div class="norm-d">
            <div class="js-tabs js-tabs-d">
                <div class="row">
                    <div class="col-md-7">
                        <ul class="js-tabs__header tabs__list">
                            <li class="tab @if(!$openedTab) is-active @endif">Текст</li>
                            <li class="tab">Оглавление</li>
                            <li class="tab">Приложения</li>
                            <li class="tab @if($openedTab == 'connections') is-active @endif">Связи</li>
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
                    <div class="js-tabs__content @if(!$openedTab) is-active @endif">
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
                    <div class="js-tabs__content">
                        <ul class="norm-list">
                            @if($titles)
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
                    <div class="js-tabs__content">
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
                    <div class="js-tabs__content @if($openedTab == 'connections') is-active @endif">
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
    <script>
        (function() {
            // выбор редакции
            if (document.querySelector('.norm-select__top')) {
                let normSelectTop = document.querySelector('.norm-select__top')
                normSelectTop.addEventListener('click', function() {
                    normSelectTop.closest('.norm-select').classList.toggle('active')
                })

                let outElem = document.querySelector('.norm-select');
                document.addEventListener('click', function(event) {
                    let isClickInside = outElem.contains(event.target);
                    if (!isClickInside) {
                        outElem.classList.remove('active')
                    }
                });

                let normSelectData = document.querySelector('.norm-select-data')
                let letNormSelectLi = document.querySelectorAll('.norm-select__bot li')
                letNormSelectLi.forEach(el => el.addEventListener('click', function() {
                    normSelectData.textContent = el.textContent
                    outElem.classList.remove('active')
                }))
            }
        })();

        const elements = document.querySelectorAll('.redaction-li');
        elements.forEach(element => {
            element.addEventListener('click', () => {
                history.pushState(null, null, window.location.pathname + '?redaction=' + element.getAttribute('data-redaction'));
            });
        });

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
    </script>
    @if(!$changes)
        <style>
            .comment {
                display:none;
            }
        </style>
    @endif
</div>
