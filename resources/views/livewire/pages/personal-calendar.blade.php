<div>
    <h1 class="title">{{ __('titles.personal_calendar') }}</h1>
    <div class="calendar2">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="calendar__select-wrap">
                    @if($months)
                        <select class="select" wire:change="setMonth($event.target.value)">
                            @foreach($months as $key => $month)
                                <option value="{{ str_pad($key, 2, "0", STR_PAD_LEFT) }}" @if($key == $selectedMonth) selected @endif>{{ $month }}</option>
                            @endforeach
                        </select>
                    @endif

                    @if($years)
                        <select class="select" wire:change="setYear($event.target.value)">
                            @foreach($years as $year)
                                <option value="{{ $year['year'] }}" @if($year['year'] == $selectedYear) selected @endif>{{ $year['year'] }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div id="calendar2">
                    <div class="datepicker datepicker-inline active">
                        <div class="datepicker-picker">
                            <div class="datepicker-header">
                                <div class="datepicker-title" style="display: none;"></div>
                                <div class="datepicker-controls">
                                    <button type="button" class="button view-switch">{{ $selectedDate }}</button>
                                </div>
                            </div>
                            <div class="datepicker-main">
                                <div class="datepicker-view">
                                    <div class="days">
                                        <div class="days-of-week">
                                            <span class="dow">Пн</span>
                                            <span class="dow">Вт</span>
                                            <span class="dow">Ср</span>
                                            <span class="dow">Чт</span>
                                            <span class="dow">Пт</span>
                                            <span class="dow">Сб</span>
                                            <span class="dow">Вс</span>
                                        </div>
                                        <div class="datepicker-grid">
                                            @php
                                                $date = 1;
                                            @endphp
                                            @for ($i = 0; $i < 6; $i++)
                                                @for ($j = 0; $j < 7; $j++)
                                                    @if ($i === 0 && $j < $firstDay)
                                                        <span class="datepicker-cell day prev"></span>
                                                    @elseif ($date > $daysInMonth)
                                                        <span class="datepicker-cell day next"></span>
                                                    @else
                                                        <span class="datepicker-cell day @if($date == $selectedDay) selected focused @endif" wire:model="selectedDay" wire:click="setDay({{ $date }})">{{ $date }}</span>
                                                        @php
                                                            $date++;
                                                        @endphp
                                                    @endif
                                                @endfor
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="calendar__block">
                    <div class="calendar__top2">
                        Отчеты
                        <span>
                            <button type="button" id="open-otchet-list" class="btn btn-primary">Добавить отчет</button>
                        </span>
                    </div>
                    <div class="calendar__list">
                        @if(count($usersCalendarReports))
                            @foreach($usersCalendarReports as $usersCalendarReport)
                                <div class="calendar__child">
                                    <button type="button" class="calendar-more-btn" onclick="openReport()">
                                        <div class="calendar-more-btn1">открыть <i class="fas fa-chevron-down"></i></div>
                                        <div class="calendar-more-btn2">Закрыть <i class="fas fa-chevron-up"></i></div>
                                    </button>
                                    <div class="calendar__item__v">
                                        <div class="calendar__item this cal-buh">
                                            <span>{{ $usersCalendarReport['dateDayOfTheWeek'] }}</span>
                                            <span class="calendar-item__day">{{ $usersCalendarReport['dateDay'] }}</span> {{ $usersCalendarReport['dateMonthYear'] }}
                                        </div>
                                        <div class="calendar__item__v2">
                                            {{ $usersCalendarReport['title'] }}
                                        </div>
                                        <div class="calendar__item__v3">
                                            {{ $usersCalendarReport['eventType'] }}
                                        </div>
                                    </div>
                                    <div class="calendar__item__h">
                                        <div class="calendar__item__h__row">
                                            @if($usersCalendarReport['note'])
                                                <div class="calendar__item__h__item">
                                                    <div class="calendar__item__h__name">Примечание</div>
                                                    <p>
                                                        {{ $usersCalendarReport['note'] }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if($usersCalendarReport['base'])
                                                <div class="calendar__item__h__item">
                                                    <div class="calendar__item__h__name">Основание</div>
                                                    <p>
                                                        {{ $usersCalendarReport['base'] }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if($usersCalendarReport['forms'])
                                                <div class="calendar__item__h__item">
                                                    <div class="calendar__item__h__name">Форма</div>
                                                    <p>
                                                        @foreach($usersCalendarReport['forms'] as $form)
                                                            <a href="{{ $form['link'] }}"><i class="fas fa-file"></i> {{ $form['title'] }}</a>
                                                        @endforeach
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="calendar__child">
                                Список отчетов на выбранный день пуст.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="choose_otchet" class="choose_otchet">
        <div class="choose_otchet__wrap">
            <div id="choose_otchet__close" class="choose_otchet__close">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="svg-inline--fa fa-times fa-w-11"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" class=""></path></svg>
            </div>
            <div class="calendar__list">
                @if(count($allCalendarReports))
                    @foreach($allCalendarReports as $allCalendarReport)
                        <div class="calendar__child">
                            <button type="button" class="calendar-more-btn2 btn btn-primary" wire:click="addReportToPersonalCalendar({{ $allCalendarReport['id'] }})">
                                Добавить
                            </button>
                            <div class="calendar__item__v">
                                <div class="calendar__item this cal-buh">
                                    <span>{{ $allCalendarReport['dateDayOfTheWeek'] }}</span>
                                    <span class="calendar-item__day">{{ $allCalendarReport['dateDay'] }}</span> {{ $allCalendarReport['dateMonthYear'] }}
                                </div>
                                <div class="calendar__item__v2">
                                    {{ $allCalendarReport['title'] }}
                                </div>
                                <div class="calendar__item__v3">
                                    {{ $allCalendarReport['eventType'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="calendar__child">
                        <div class="calendar__item__v">
                            Список отчетов на выбранный день пуст.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function openReport() {
            const button = event.target.parentNode;
            button.closest('.calendar__child').classList.toggle("active");
            slideToggle(button.closest('.calendar__child').querySelector('.calendar__item__h'), 200);
        }

        document.addEventListener('livewire:update', function () {
            (function() {
                if (document.querySelectorAll(".select").length) {
                    var els = document.querySelectorAll(".select");
                    els.forEach(function(select) {
                        NiceSelect.bind(select);
                    });
                }
            })();
        })
    </script>
</div>
