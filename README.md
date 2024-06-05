Twig extension : time
=====================

## Installation & Requirements

Install with [Composer](https://getcomposer.org):

```shell script
composer require jmf/twig-time
```

PHP intl extension is required if you need to use internationalized date formats. 

## Usage in Twig templates

### microtime() function

Returns current microtime (timestamp with milli/microseconds)

```html
{% set now = microtime() %}
```

### intl_format() filter

Formats provided IntlCalendar / DateTime object with internationalization.

See https://unicode-org.github.io/icu/userguide/format_parse/datetime/#datetime-format-syntax for available formatting tokens.

```html
{{ date|intl_format('cccc', 'fr_CA.UTF-8') }}
```
