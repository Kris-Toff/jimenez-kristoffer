<?php

namespace App\Http\Controllers;

use App\Models\BusinessHour;
use Illuminate\Http\Request;

class BusinessHoursController extends Controller
{
    public function update(Request $request)
    {
        BusinessHour::where('id', $request->id)
            ->update($request->all());


        return redirect()->intended('dashboard');
    }
}
