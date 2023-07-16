<?php

namespace App\Http\Livewire;

use App\Http\Presenters\Calendar\GetCalendarReportAsArrayPresenter;
use App\Http\Presenters\Calendar\GetCalendarTaxPaymentDayAsArrayPresenter;
use App\Http\Presenters\Calendar\GetCalendarWeekendDayAsArrayPresenter;
use App\Http\Presenters\Calendar\GetCalendarYearAsArrayPresenter;
use App\Models\CalendarReport;
use App\Models\CalendarTaxPaymentDay;
use App\Models\CalendarWeekendDay;
use App\Models\CalendarYear;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class AccountantCalendar extends Component
{
    public $years;
    public $months;

    public $selectedYear;
    public $selectedMonth;
    public $selectedDay;
    public $selectedDate;

    public $eventType;
    public $firstDay;
    public $daysInMonth;

    public $allCalendarReports;
    public $allWeekendDays;
    public $allTaxPaymentDays;

    public function mount(
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
        GetCalendarYearAsArrayPresenter $calendarYearArrayPresenter,
        Request $request,
    ): void
    {
        $this->selectedYear = $request->input('y') ?? date('Y');
        $this->selectedMonth = $request->input('m') ?? date('m');
        $this->selectedDay = $request->input('d') ?? null;
        $this->selectedDate = $this->getSelectedDate();

        $years = CalendarYear::query()->where('active', true)->get();
        $this->years = $calendarYearArrayPresenter->presentCollection($years);

        $this->setMonths();
        $this->setFirstDayAndDaysInMonth();
        $this->getWeekendAndTaxPaymentDays();

        if(
            $request->input('y') &&
            $request->input('m') &&
            $request->input('d')
        ) {
            $allCalendarReports = CalendarReport::query()
                ->where('date', $request->input('y') . '-' . $request->input('m') . '-' . $request->input('d'))
                ->get();
        } elseif($this->selectedDay) {
            $allCalendarReports = CalendarReport::query()
                ->where('date', $this->selectedYear . '-' . $this->selectedMonth . '-' . $this->selectedDay)
                ->get();
        } else {
            $allCalendarReports = $this->getAllReportsOfTheMonth();
        }

        $this->allCalendarReports = $calendarReportArrayPresenter->presentCollection($allCalendarReports);
    }

    private function getWeekendAndTaxPaymentDays() {
        $calendarWeekendDayArrayPresenter = new GetCalendarWeekendDayAsArrayPresenter();
        $calendarTaxPaymentDayArrayPresenter = new GetCalendarTaxPaymentDayAsArrayPresenter();

        $currentYearAndMonth = Carbon::createFromDate(intval($this->selectedYear), intval($this->selectedMonth));
        $startDate = Carbon::createFromDate(intval($this->selectedYear), intval($this->selectedMonth), 1);;
        $endDate = $currentYearAndMonth->endOfMonth();

        $calendarWeekendDays = CalendarWeekendDay::whereBetween('date', [$startDate, $endDate])->get();
        $this->allWeekendDays = $calendarWeekendDayArrayPresenter->presentCollection($calendarWeekendDays);

        $calendarTaxPaymentDays = CalendarTaxPaymentDay::whereBetween('date', [$startDate, $endDate])->get();
        $this->allTaxPaymentDays = $calendarTaxPaymentDayArrayPresenter->presentCollection($calendarTaxPaymentDays);
    }

    public function setYear(
        $year,
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
    ) {
        $this->eventType = 0;

        $this->selectedYear = $year;
        $this->selectedMonth = '01';
        $this->selectedDay = '';
        $this->selectedDate = $this->getSelectedDate();

        $this->setMonths();
        $this->setFirstDayAndDaysInMonth();
        $this->getWeekendAndTaxPaymentDays();

        $allCalendarReports = $this->getAllReportsOfTheMonth();
        $this->allCalendarReports = $calendarReportArrayPresenter->presentCollection($allCalendarReports);
    }

    public function setMonth(
        $month,
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
    ) {
        $this->eventType = 0;

        $this->selectedMonth = (string) $month;
        $this->selectedDay = '';
        $this->selectedDate = $this->getSelectedDate();

        $this->setFirstDayAndDaysInMonth();
        $this->getWeekendAndTaxPaymentDays();

        $allCalendarReports = $this->getAllReportsOfTheMonth();
        $this->allCalendarReports = $calendarReportArrayPresenter->presentCollection($allCalendarReports);
    }

    public function setDay(
        $day,
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
    ) {
        $this->eventType = 0;
        $this->selectedDay = $day;
        $currentDate = $this->selectedYear . '-' . $this->selectedMonth . '-' . sprintf('%02d', $this->selectedDay);

        $allCalendarReports = CalendarReport::query()
            ->where('date', $currentDate)
            ->get();
        $this->allCalendarReports = $calendarReportArrayPresenter->presentCollection($allCalendarReports);
    }

    public function setEventType(
        $eventType,
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
    ) {
        $this->eventType = $eventType;

        if($this->selectedDay){
            $currentDate = $this->selectedYear . '-' . $this->selectedMonth . '-' . sprintf('%02d', $this->selectedDay);
            $allCalendarReports = CalendarReport::query()
                ->where([
                    ['date', $currentDate],
                    ['event_type', $this->eventType],
                ])
                ->get();
        } else {
            $allCalendarReports = CalendarReport::query()
                ->where([
                    ['event_type', $this->eventType],
                ])
                ->whereYear('date', $this->selectedYear)
                ->whereMonth('date', $this->selectedMonth)
                ->whereDay('date', '>=', 1)
                ->whereDay('date', '<=', Carbon::parse($this->selectedYear . '-' . $this->selectedMonth)->endOfMonth()->day)
                ->orderBy('date')
                ->get();
        }

        $this->allCalendarReports = $calendarReportArrayPresenter->presentCollection($allCalendarReports);
    }

    private function getAllReportsOfTheMonth()
    {
        return CalendarReport::query()
            ->whereYear('date', $this->selectedYear)
            ->whereMonth('date', $this->selectedMonth)
            ->whereDay('date', '>=', 1)
            ->whereDay('date', '<=', Carbon::parse($this->selectedYear . '-' . $this->selectedMonth)->endOfMonth()->day)
            ->orderBy('date')
            ->get();
    }

    private function getSelectedDate()
    {
        return mb_convert_case(mb_strtolower(Carbon::createFromDate(null, $this->selectedMonth)->locale('ru')->monthName, 'UTF-8'), MB_CASE_TITLE, "UTF-8") . ' ' . $this->selectedYear;
    }

    private function setMonths()
    {
        for ($i = 1; $i <= 12; $i++) {
            $this->months[$i] = Carbon::create()->month($i)->translatedFormat('F');
        }
    }

    private function setFirstDayAndDaysInMonth()
    {
        $date = Carbon::createFromDate($this->selectedYear, $this->selectedMonth, 1);
        $this->firstDay = ($date->dayOfWeek - 1 == -1) ? 6 : $date->dayOfWeek - 1;
        $this->daysInMonth = $date->daysInMonth;
    }

    public function render()
    {
        return view('livewire.pages.accountant-calendar');
    }
}
