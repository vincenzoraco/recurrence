<?php

namespace VincenzoRaco\Recurrence;

use Carbon\Carbon;
use RRule\RRule;

class Recurrence
{
    private RRule $rule;

    private $occurrences;

    private Carbon $now;

    private string $carbonFormat;

    public function __construct(RRule $rule, Carbon $now = null, string $carbonFormat = null)
    {
        $this->rule = $rule;

        $this->now = $now ?? new Carbon();

        $this->carbonFormat = $carbonFormat ?? 'Y-m-d H:i:s';

        $this->occurrences = collect($this->rule);
    }

    public function occurrences(): array
    {
        return $this->occurrences->toArray();
    }

    public function isOccurringToday(): bool
    {
        return $this->occurrences->contains(function ($occurrenceDate) {
            return $occurrenceDate->format('Y-m-d') === $this->now->format('Y-m-d');
        });
    }

    public function isOccurringOn(Carbon $date): bool
    {
        return $this->occurrences->contains(function ($occurrenceDate) use ($date) {
            return $occurrenceDate->format('Y-m-d') === $date->format('Y-m-d');
        });
    }

    public function nextOccurrence(): ?Carbon
    {
        $next_occurrence = null;

        foreach ($this->occurrences as $occurrenceDate) {
            if ($occurrenceDate->format($this->carbonFormat) >= $this->now->format($this->carbonFormat)) {
                $next_occurrence = new Carbon($occurrenceDate);

                break;
            }
        }

        return $next_occurrence;
    }
}
