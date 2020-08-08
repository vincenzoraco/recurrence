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
``` php
$rrule = new RRule([
    // make sure it is a string and not a Datetime or Carbon instance
    'dtstart' => Carbon::now()->format('Y-m-d H:i:s'),
    'freq' => 'WEEKLY',
    'count' => 20,
]);

$recurrence = new VincenzoRaco\Recurrence($rrule);

echo recurrence->nextOccurrence()->format('Y-m-d');
// 2020-08-09
```

Please check the tests' folder for more examples.

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
