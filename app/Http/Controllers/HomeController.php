<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\BusinessHour;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $day = $now->copy()->format('l');

        $bakery_opening_hours = false;
        $bakery_status = false;
        $is_open_every_other_week = false;
        $next_open_date = null;
        $is_at_lunch = false;
        $show_datetime = false;

        $business_hours = BusinessHour::where('name', $day)->first();

        if ($business_hours->is_open) {
            $bakery_status = true;

            $open_at = Carbon::createFromTimeString($business_hours->open_at);
            $lunch_start = Carbon::createFromTimeString($business_hours->lunch_start);
            $close_at = Carbon::createFromTimeString($business_hours->close_at);
            $lunch_end = Carbon::createFromTimeString($business_hours->lunch_end);

            if ($now->copy()->between($open_at, $close_at))
                $bakery_opening_hours = true;

            if ($now->copy()->between($lunch_start, $lunch_end))
                $is_at_lunch = true;

            if ($is_at_lunch) {
                $next_open_date = $lunch_end->copy()->addMinute(1)->toDateTimeString();
                $show_datetime = true;
            }

            $is_open_every_other_week = $this->checkEveryOtherWeek($business_hours, $now);
        }

        $is_open = $bakery_status && $is_open_every_other_week && $bakery_opening_hours && !$is_at_lunch;

        if (!$is_open && !$is_at_lunch)
            $next_open_date = $this->getNextOpenDay(Carbon::createFromTimeString($business_hours->open_at));


        if (!$is_open && !$bakery_opening_hours) {
            $next_open_date = $open_at->copy()->addMinute(1)->toDateTimeString();
            $show_datetime = true;
        }

        return Inertia::render('Home', [
            'status' => [
                'is_open' => $is_open,
                'next_open_date' => $next_open_date,
                'show_datetime' => $show_datetime,
            ]
        ]);
    }

    public function status(Request $request)
    {
        $date = Carbon::create($request->date);
        $day = $date->copy()->format('l');

        $bakery_status = false;
        $is_open_every_other_week = false;
        $next_open_date = null;

        $business_hours = BusinessHour::where('name', $day)->first();

        if ($business_hours->is_open) {
            $bakery_status = true;

            $is_open_every_other_week = $this->checkEveryOtherWeek($business_hours, $date);
        }

        $is_open = $bakery_status && $is_open_every_other_week;

        if (!$is_open)
            $next_open_date = $this->getNextOpenDay($date);

        $status = [
            'is_open' => $is_open,
            'other' => $is_open_every_other_week,
            'b' => $business_hours,
            'next_open_date' => $next_open_date
        ];

        return response()->json($status);
    }

    private function getNextOpenDay($date, $human_readable = false)
    {
        $max_days = 30;
        $next_open_date = null;

        for ($i = 1; $i <= $max_days; $i++) {
            $dt = $date->addDay(1);
            $day = $dt->format('l');

            $business_hours = BusinessHour::where('name', $day)->where('is_open', true)->first();

            if ($business_hours) {
                $next_open_date = $dt;
                break;
            }
        }

        return $next_open_date->toDateString();
    }

    private function checkEveryOtherWeek($business_hours, $now)
    {
        $is_open = true;

        if (!$business_hours->is_every_other_week)
            return $is_open;

        if (!$business_hours->start_date)
            return $is_open;


        $start_date = Carbon::create($business_hours->start_date);
        $db_week_interval = $start_date->copy()->weekOfYear() % 2;
        $current_interval = $now->copy()->weekOfYear() % 2;

        if ($db_week_interval != $current_interval)
            $is_open = false;


        return $is_open;
    }
}
