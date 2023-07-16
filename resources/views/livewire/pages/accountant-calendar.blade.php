<div>
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
                <div id="calendar">
                    <div class="datepicker datepicker-inline active">
                        <div class="datepicker-picker">
                            <div class="datepicker-header">
                                <div class="datepicker-title" style="display: none;"></div>
                                <div class="datepicker-controls">
                                    <button type="button" wire:click="setMonth({{ $selectedMonth }})" class="button view-switch">{{ $selectedDate }}</button>
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
                                                        <span class="datepicker-cell day
                                                            @if($date == $selectedDay) selected focused
                                                            @elseif(in_array($date, $allTaxPaymentDays)) blue
                                                            @elseif($j == 5 || $j == 6 || in_array($date, $allWeekendDays)) highlighted
                                                            @endif
                                                        " wire:model="selectedDay" wire:click="setDay({{ $date }})">{{ $date }}</span>
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
                <div class="calendar__text">
                    <p>
                        <span style="color: #ff0000;">Красный</span> - Выходные и праздничные дни
                    </p>
                    <p>
                        <span style="color: #167bc1;">Синий</span> - Даты подачи отчетности или уплаты налогов
                    </p>
                    <p>
                        <b>П.С.П.О.*</b> - Последний срок подачи отчета
                    </p>
                    <p>
                        <b>П.С.У.*</b> - Последний срок оплаты налога, сбора и другого платежа
                    </p>
                    <p>
                        *Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas reprehenderit in explicabo, doloribus deleniti id voluptate enim error asperiores porro amet veniam iusto at ab?
                    </p>
                </div>
                <div class="calendar__text__bot">
                    См.также:<br>
                    <a href="">Производственый календарь на 2020</a>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="calendar__block">
                    <div class="calendar__top2">
                        {{ __('titles.accountant_calendar') }}
                        <span>
                            <select class="select" wire:change="setEventType($event.target.value)">
                                <option value="0" @if($eventType == 0) selected @endif>Все события</option>
                                <option value="1" @if($eventType == 1) selected @endif>П.С.П.О.</option>
                                <option value="2" @if($eventType == 2) selected @endif>П.С.У.</option>
                            </select>
                        </span>
                    </div>
                    <div class="calendar__list">
                        @if(count($allCalendarReports))
                            @foreach($allCalendarReports as $allCalendarReport)
                                <div class="calendar__child">
                                    <button type="button" class="calendar-more-btn" onclick="openReport()">
                                        <div class="calendar-more-btn1">открыть <i class="fas fa-chevron-down"></i></div>
                                        <div class="calendar-more-btn2">Закрыть <i class="fas fa-chevron-up"></i></div>
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
                                    <div class="calendar__item__h">
                                        <div class="calendar__item__h__row">
                                            @if($allCalendarReport['note'])
                                                <div class="calendar__item__h__item">
                                                    <div class="calendar__item__h__name">Примечание</div>
                                                    <p>
                                                        {{ $allCalendarReport['note'] }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if($allCalendarReport['base'])
                                                <div class="calendar__item__h__item">
                                                    <div class="calendar__item__h__name">Основание</div>
                                                    <p>
                                                        {{ $allCalendarReport['base'] }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if($allCalendarReport['forms'])
                                                <div class="calendar__item__h__item">
                                                    <div class="calendar__item__h__name">Форма</div>
                                                    <p>
                                                        @foreach($allCalendarReport['forms'] as $form)
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
                                <div class="calendar__item__v">
                                    Список отчетов на выбранный день пуст.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
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
