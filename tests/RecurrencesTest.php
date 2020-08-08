<?php

use Carbon\Carbon;
use function Tests\generateRRule;
use VincenzoRaco\Recurrence\Recurrence;
use VincenzoRaco\Recurrence\Recurrences;

it('can verify the next occurrence of a given recurrences array', function () {
    $rrules = [];

    for ($i = 0; $i < 10; $i++) {
        $rrules[ random_int(10000, 99999) ] = generateRRule([
            'dtstart' => Carbon::now()->subDays($i)->format('Y-m-d H:i:s'),
        ]);
    }

    $recurrences = new Recurrences($rrules);

    $occurrences = collect($recurrences->nextOccurrences());

    assertEquals(10, $occurrences->count());

    $occurrences->each(function ($occurrence, $key) use ($rrules) {
        $recurrence = new Recurrence($rrules[$key]);

        assertEquals($recurrence->nextOccurrence()->format('Y-m-d'), $occurrence->format('Y-m-d'));
    });
});
