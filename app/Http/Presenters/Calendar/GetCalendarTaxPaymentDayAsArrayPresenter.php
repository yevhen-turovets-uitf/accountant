<?php

namespace App\Http\Presenters\Calendar;

use App\Contracts\PresenterCollectionInterface;
use App\Models\CalendarTaxPaymentDay;
use Illuminate\Support\Collection;

class GetCalendarTaxPaymentDayAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (CalendarTaxPaymentDay $calendarTaxPaymentDay) {
                    return $this->present($calendarTaxPaymentDay);
                }
            )
            ->all();
    }

    public function present(CalendarTaxPaymentDay $calendarTaxPaymentDay): int
    {
        return $calendarTaxPaymentDay->getDate()->day;
    }
}
