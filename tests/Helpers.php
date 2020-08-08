<?php

namespace Tests;

use Carbon\Carbon;
use RRule\RRule;

function generateRRule($rrule = [])
{
    $rrule = array_merge([
        'dtstart' => Carbon::now()->format('Y-m-d H:i:s'),
        'freq' => 'WEEKLY',
        'count' => 20,
    ], $rrule);

    return new RRule($rrule);
}
