<?php

namespace App\Http\Controllers;

use App\Models\BusinessHour;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $businessHours = BusinessHour::all();

        return Inertia::render('Dashboard', [
            'business_hours' => $businessHours
        ]);
    }
}
