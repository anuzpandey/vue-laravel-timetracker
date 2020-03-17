<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = ['name', 'userId'];
    protected $primaryKey = 'projectId';

    /**
     * @var array
     * // with array used to specify relationships to eagerly load.
     */
    protected $with = ['user'];

    /**
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function timer() {
        return $this->belongsTo(Timer::class);
    }

    /**
     * @param $query
     * @return mixed
     * // Finally, we define an Eloquent Query Scope [https://laravel.com/docs/5.5/eloquent#query-scopes] in the scopeMine method.
     *    Query scopes make it easier to mask complex queries in an Eloquent model.
     *    The scopeMine is supposed to add the where a query that restricts the projects
     *    to only those belonging to the current user.
     */
    public function scopeMine($query) {
        return $query->whereUserId(auth()->user()->userId);
    }
}
