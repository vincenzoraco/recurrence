<?php

namespace VincenzoRaco\Recurrence;

use Tightenco\Collect\Support\Collection;

class Recurrences
{
    private Collection $recurrences;

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
