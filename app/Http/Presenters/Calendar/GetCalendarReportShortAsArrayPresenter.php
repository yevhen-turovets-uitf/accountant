<?php

namespace App\Http\Presenters\Calendar;

use App\Contracts\PresenterCollectionInterface;
use App\Enums\EventType;
use App\Models\CalendarReport;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class GetCalendarReportShortAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (CalendarReport $calendarReport) {
                    return $this->present($calendarReport);
                }
            )
            ->all();
    }

    public function present(CalendarReport $calendarReport): array
    {
        $date = Carbon::parse($calendarReport->getDate());
        $dayOfWeekIndex = $date->dayOfWeek;
        $monthIndex = $date->month;

        return [
            'id' => $calendarReport->getId(),
            'dateDayOfTheWeek' => __('calendar.days.' . $dayOfWeekIndex),
            'dateDay' => $date->format('d'),
            'dateMonthYear' => __('calendar.months.' . $monthIndex) . ' ' . $date->format('y'),
            'title' => $calendarReport->getTitle(),
            'note' => $calendarReport->getNote(),
            'eventType' => __('calendar.events.' . EventType::from($calendarReport->getEventType())->name),
        ];
    }
}
