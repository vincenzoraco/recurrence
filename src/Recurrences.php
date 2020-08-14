<?php

namespace VincenzoRaco\Recurrence;

class Recurrences
{
    private $recurrences;

    public function __construct(array $recurrences)
    {
        $this->recurrences = collect($recurrences);
    }

    public function nextOccurrences(): array
    {
        return $this->recurrences->map(function ($rrule) {
            $recurrence = new Recurrence($rrule);

            return $recurrence->nextOccurrence();
        })->toArray();
    }
}
