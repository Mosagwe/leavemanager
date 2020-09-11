<?php

namespace App\Http\Controllers;

use App\Calculators\LeaveDatesCalculator;
use App\Models\Holiday;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DateController extends Controller
{
    public function disabled(Request $request)
    {
        $calculator = new LeaveDatesCalculator();

        $holidays = Holiday::all()->pluck('date')->toArray();

        $activeDates = Arr::flatten($calculator->futureLeaveDays($request->leave_request_id));

        return new JsonResponse(array_merge($holidays, $activeDates));
    }
}
