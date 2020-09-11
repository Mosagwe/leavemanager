<?php

namespace App\Calculators;

use App\Models\Holiday;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class LeaveDatesCalculator
{
    /**
     * Get the date a leave should end.
     *
     * @param LeaveType $leaveType
     * @param Carbon $startDate
     * @param int $days
     * @return Carbon
     */
    public function endDate(LeaveType $leaveType, Carbon $startDate, int $days)
    {
        if ($leaveType->calendar_days) {
            return $startDate->addDays($days);
        }

        $holidays = Holiday::all();

        for ($i = 1; $i < $days; $i++) {
            $this->addDay($startDate, $holidays);
        }

        return $startDate;
    }

    /**
     * The date the employee should return to work.
     *
     * @param Carbon $date
     * @return Carbon
     */
    public function returnDate(Carbon $date)
    {
        $holidays = Holiday::all();

        do {
            $date->addDay();
        } while ($date->isSaturday() || $date->isSunday() ||
        $holidays->contains('date', $date->format('Y-m-d')));

        return $date;
    }

    /**
     * Get the next validate date
     *
     * @param Carbon $date
     * @return Carbon
     */
    protected function addDay(Carbon $date, Collection $holidays)
    {
        $date->addDay();

        // Move next day if weekend
        if ($date->isSaturday() || $date->isSunday()) {
            $this->addDay($date, $holidays);
        }

        // Move to next day if holiday
        if ($holidays->contains('date', $date->format('Y-m-d'))) {
            $this->addDay($date, $holidays);
        }

        return $date;
    }

    public function futureLeaveDays($id = null)
    {
        $leave_requests = LeaveRequest::activeRequests();

        if (!is_null($id)) {
            $leave_requests->where('id', '<>', $id);
        }

        $requests = $leave_requests->get();

        if (is_null($requests)) {
            return null;
        }

        $dates = [];

        foreach ($requests as $leave_request) {
            $dates[] = $this->dateRange($leave_request->start_at, $leave_request->end_at);
        }

        return $dates;
    }

    /**
     * Compute a range between two dates, and generate
     * a plain array of Carbon objects of each day in it.
     *
     * @param Carbon $from
     * @param Carbon $to
     * @param bool $inclusive
     * @return array|null
     */
    protected function dateRange(Carbon $from, Carbon $to, $inclusive = true)
    {
        if ($from->gt($to)) {
            return null;
        }

        // Clone the date objects to avoid issues, then reset their time
        $from = $from->copy()->startOfDay();
        $to = $to->copy()->startOfDay();

        // Include the end date in the range
        if ($inclusive) {
            $to->addDay();
        }

        $step = CarbonInterval::day();
        $period = new DatePeriod($from, $step, $to);

        $range = [];

        foreach ($period as $day) {
            $range[] = (new Carbon($day))->format('Y-m-d');
        }

        return !empty($range) ? $range : null;
    }
}
