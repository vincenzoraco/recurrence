# An agnostic RRule PHP helper to manage recurrences

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vincenzoraco/recurrence.svg?style=flat-square)](https://packagist.org/packages/vincenzoraco/recurrence)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vincenzoraco/recurrence/Tests?label=tests)](https://github.com/vincenzoraco/recurrence/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/vincenzoraco/recurrence.svg?style=flat-square)](https://packagist.org/packages/vincenzoraco/recurrence)

This package aims to help manage recurrences using the standard [RRule](https://tools.ietf.org/html/rfc5545).

Please note that you need to use [rlanvin/php-rrule](https://github.com/rlanvin/php-rrule) to work with this package.

## Installation

You can install the package via composer:

```bash
composer require vincenzoraco/recurrence
```

## Usage

The package will provide different methods; below you can see them in action.

```php
$rrule = new RRule([
    // make sure it is a string and not a Datetime or Carbon instance
    'dtstart' => Carbon::now()->format('Y-m-d H:i:s'),
    'freq' => 'WEEKLY',
    'count' => 20,
]);

// Given a RRule instance
$recurrence = new VincenzoRaco\Recurrence($rrule);

// We have the following methods

// Carbon|Null
$next_occurrence = $recurrence->nextOccurrence();

if ($next_occurrence) {
    echo $next_occurrence->format('Y-m-d');
    // 2020-08-09
}

$recurrence->occurrences();
// it returns a collection of Carbon instances that you can iterate

$recurrence->isOccurringToday();
// true|false

$recurrence->isOccurringOn(Carbon::now());
// true|false
```

We can also give an Array of RRule instances to the `Recurrences` class:

```php
$rrules = [];

for ($i = 0; $i < 10; $i++) {
    $rrule = new RRule([
        // make sure it is a string and not a Datetime or Carbon instance
        'dtstart' => Carbon::now()->format('Y-m-d H:i:s'),
        'freq' => 'WEEKLY',
        'count' => 20,
    ]);

    // The array key should be the reference number of the RRule instance, usually the database ID.
    $rrules[ random_int(10000, 99999) ] = $rrule;
}

// We initiating the class with the RRule array, which will be converted into a Collection instance.
$recurrences = new Recurrences($rrules);

// Be mindful that an occurrence may be null or be a Carbon Instance
$recurrences->nextOccurrences();
/**
  array:10 [
    49819 => Carbon\Carbon|null,
    68604 => Carbon\Carbon|null,
    ...
  ]
 */
```

## Testing
We use [PEST](https://github.com/pestphp/pest) for testing.
``` bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Vincenzo Raco](https://github.com/vincenzoraco)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
