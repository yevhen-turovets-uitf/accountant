<?php

namespace App\Http\Presenters\Calendar;

use App\Contracts\PresenterCollectionInterface;
use App\Models\CalendarWeekendDay;
use Illuminate\Support\Collection;

class GetCalendarWeekendDayAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (CalendarWeekendDay $calendarWeekendDay) {
                    return $this->present($calendarWeekendDay);
                }
            )
            ->all();
    }

    public function present(CalendarWeekendDay $calendarWeekendDay): int
    {
        return $calendarWeekendDay->getDate()->day;
    }
}
