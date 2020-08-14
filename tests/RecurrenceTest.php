<?php

use Carbon\Carbon;
use function Tests\generateRRule;
use VincenzoRaco\Recurrence\Recurrence;

it('has occurrences', function () {
    $recurrence = new Recurrence(generateRRule());

    assertEquals(20, count($recurrence->occurrences()));
});

it('can retrieve the next occurrence', function () {
    $recurrence = new Recurrence(generateRRule());

    assertEquals(
        Carbon::now()->format('Y-m-d'),
        $recurrence->nextOccurrence()->format('Y-m-d')
    );
});

it('it returns null if it does not have a next occurrence', function () {
    $recurrence = new Recurrence(generateRRule([
        'dtstart' => Carbon::now()->subYear()->format('Y-m-d H:i:s'),
        'count' => 1,
    ]));

    assertNull($recurrence->nextOccurrence());
});

it('can verify if it occurs today', function () {
    $recurrence = new Recurrence(generateRRule());

    assertTrue($recurrence->isOccurringToday());
});

it('can verify if it occurs on a specific date', function () {
    $recurrence = new Recurrence(generateRRule());

    assertTrue($recurrence->isOccurringOn(Carbon::now()));

    assertFalse($recurrence->isOccurringOn(Carbon::now()->subDay()));

    assertFalse($recurrence->isOccurringOn(Carbon::now()->addDay()));
});
