<?php

namespace App\Http\Controllers;

use App\Timer;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     * // This method just creates a new timer and associates it with the loaded project.
     */
    public function store(Request $request, int $id) {
        $data = $request->validate(['name' => 'required|between:3,100']);

        $timer = Project::mine()->findOrFail($id)
            ->timers()
            ->save(new Timer([
                'name' => $data['name'],
                'userId' => Auth::user()->userId,
                'started_at' => new Carbon,
            ]));

        return $timer->with('project')->find($timer->timerId);
    }

    /**
     * @return array
     * // returns active timers belonging to the current user
     */
    public function running(){
        return Timer::with('project')->mine()->running()->first() ?? [];
    }

    /**
     * @return mixed
     * // stops the actively running timer belonging to the current user
     */
    public function stopRunning(){
        if ($timer = Timer::mine()->running()->first()) {
            $timer->update(['stoppedAt' => new Carbon]);
        }
        return $timer;
    }
}
