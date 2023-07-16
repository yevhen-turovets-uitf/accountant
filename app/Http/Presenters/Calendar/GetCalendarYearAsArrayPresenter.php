<?php

namespace App\Http\Presenters\Calendar;

use App\Contracts\PresenterCollectionInterface;
use App\Models\CalendarYear;
use Illuminate\Support\Collection;

class GetCalendarYearAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (CalendarYear $calendarYear) {
                    return $this->present($calendarYear);
                }
            )
            ->all();
    }

    public function present(CalendarYear $calendarYear): array
    {
        return [
            'id' => $calendarYear->getId(),
            'year' => $calendarYear->getYear(),
        ];
    }
}
