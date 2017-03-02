# enum

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A very simple PHP Enum implementation.

## Install

Via Composer

``` bash
$ composer require bbrothers/enum
```

## Usage

``` php
class Weekdays extends Enum
{
    const MONDAY    = 'monday';
    const TUESDAY   = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY  = 'thursday';
    const FRIDAY    = 'friday';
}
// ...
$day = Weekdays::TUESDAY();
$day->equals(Weekdays::MONDAY()); // false
$day->isSelected(Weekdays::TUESDAY); // true
(string) $day; // tuesday
Weekdays::values(); // monday, tuesday, wednesday, thursday, friday
Weekdays::keys(); // MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- [Brad Brothers][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/bbrothers/enum.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/bbrothers/enum/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/bbrothers/enum.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/bbrothers/enum.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/bbrothers/enum.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/bbrothers/enum
[link-travis]: https://travis-ci.org/bbrothers/enum
[link-scrutinizer]: https://scrutinizer-ci.com/g/bbrothers/enum/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/bbrothers/enum
[link-downloads]: https://packagist.org/packages/bbrothers/enum
[link-author]: https://github.com/bbrothers
[link-contributors]: ../../contributors
