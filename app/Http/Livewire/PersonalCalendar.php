<?php

namespace App\Http\Livewire;

use App\Http\Presenters\Calendar\GetCalendarReportAsArrayPresenter;
use App\Http\Presenters\Calendar\GetCalendarReportShortAsArrayPresenter;
use App\Http\Presenters\Calendar\GetCalendarYearAsArrayPresenter;
use App\Models\CalendarReport;
use App\Models\CalendarYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalCalendar extends Component
{
    public $years;
    public $months;

    public $selectedYear;
    public $selectedMonth;
    public $selectedDay;
    public $selectedDate;

    public $firstDay;
    public $daysInMonth;

    public $usersCalendarReports;
    public $allCalendarReports;

    public function mount(
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
        GetCalendarReportShortAsArrayPresenter $calendarReportShortArrayPresenter,
        GetCalendarYearAsArrayPresenter $calendarYearArrayPresenter,
    ): void
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('m');
        $this->selectedDay = date('d');
        $this->selectedDate = $this->getSelectedDate();

        $years = CalendarYear::query()->where('active', true)->get();
        $this->years = $calendarYearArrayPresenter->presentCollection($years);

        $this->setMonths();
        $this->setFirstDayAndDaysInMonth();

        $currentDate = date('Y-m-d');

        $user = Auth::user();

        $usersCalendarReports = $user->calendarReports()
            ->where('date', $currentDate)
            ->get();
        $this->usersCalendarReports = $calendarReportArrayPresenter->presentCollection($usersCalendarReports);

        $allCalendarReports = CalendarReport::query()
            ->where('date', $currentDate)
            ->whereNotIn('id', $usersCalendarReports->pluck('id'))
            ->get();
        $this->allCalendarReports = $calendarReportShortArrayPresenter->presentCollection($allCalendarReports);
    }

    public function setYear(
        $year
    ) {
        $this->selectedYear = $year;
        $this->selectedMonth = '01';
        $this->selectedDay = '';
        $this->selectedDate = $this->getSelectedDate();

        $this->setMonths();
        $this->setFirstDayAndDaysInMonth();
    }

    public function setMonth(
        $month
    ) {
        $this->selectedMonth = (string) $month;
        $this->selectedDay = '';
        $this->selectedDate = $this->getSelectedDate();

        $this->setFirstDayAndDaysInMonth();
    }

    public function setDay(
        $day,
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
        GetCalendarReportShortAsArrayPresenter $calendarReportShortArrayPresenter,
    ) {

        $this->selectedDay = $day;

        $currentDate = $this->selectedYear . '-' . $this->selectedMonth . '-' . sprintf('%02d', $this->selectedDay);

        $user = Auth::user();

        $usersCalendarReports = $user->calendarReports()
            ->where('date', $currentDate)
            ->get();
        $this->usersCalendarReports = $calendarReportArrayPresenter->presentCollection($usersCalendarReports);

        $allCalendarReports = CalendarReport::query()
            ->where('date', $currentDate)
            ->whereNotIn('id', $usersCalendarReports->pluck('id'))
            ->get();
        $this->allCalendarReports = $calendarReportShortArrayPresenter->presentCollection($allCalendarReports);
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

    public function addReportToPersonalCalendar(
        $id,
        GetCalendarReportAsArrayPresenter $calendarReportArrayPresenter,
        GetCalendarReportShortAsArrayPresenter $calendarReportShortArrayPresenter,
    )
    {
        $calendarReport = CalendarReport::find($id);
        $user = Auth::user();

        $user->calendarReports()->attach($calendarReport);

        $currentDate = $this->selectedYear . '-' . $this->selectedMonth . '-' . sprintf('%02d', $this->selectedDay);

        $usersCalendarReports = $user->calendarReports()
            ->where('date', $currentDate)
            ->get();
        $this->usersCalendarReports = $calendarReportArrayPresenter->presentCollection($usersCalendarReports);

        $allCalendarReports = CalendarReport::query()
            ->where('date', $currentDate)
            ->whereNotIn('id', $usersCalendarReports->pluck('id'))
            ->get();
        $this->allCalendarReports = $calendarReportShortArrayPresenter->presentCollection($allCalendarReports);
    }

    public function render()
    {
        return view('livewire.pages.personal-calendar');
    }
}
