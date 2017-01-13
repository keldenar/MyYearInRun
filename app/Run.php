<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    //
    protected $fillable = [
        'user_id', 'distance', 'runDate',
    ];

    public  function convert($run_time)
    {
        $hours = (int) ($run_time / 3600);
        $minutes = (int) (($run_time - ($hours * 3600)) / 60);
        $seconds = $run_time - ($hours * 3600) - ($minutes * 60);
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

}
