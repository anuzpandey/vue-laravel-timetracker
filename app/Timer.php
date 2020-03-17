<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $fillable = [
        'name', 'userId', 'projectId', 'stoppedAt', 'startedAt'
    ];

    protected $primaryKey = 'timerId';

    protected $dates = [
        'stoppedAt', 'startedAt'
    ];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    /**
     * @param $query
     * @return mixed
     * // the scopeMine adds where a query for all the timers belonging to the user
     */
    public function scopeMine($query){
        return $query->whereUserId(auth()->user()->userId);
    }

    /**
     * @param $query
     * @return mixed
     * // the scopeRunning adds a where a query for all timers that are running.
     */
    public function scopeRunning($query){
        return $query->whereNull('stoppedAt');
    }
}
