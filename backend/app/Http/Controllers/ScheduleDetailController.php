<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exceptions\BadRequestException;


use App\Models\Schedule;

class ScheduleDetailController extends Controller
{
    public function detail(Request $request)
    {
        $schedule = Schedule::getScheduleByScheduleId($request->schedule_id)->first();
        if (is_null($schedule)) {
            throw new BadRequestException();
        }
        return view('schedule.schedule_detail', ['schedule' => $schedule]);
    }

    public function delete(Request $request)
    {
        Schedule::scheduleDelete($request->schedule_id);
        return redirect('/user/calendar');
    }
}
