# Pipe Operator in PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/boostphp/pipe-operator.svg?style=flat-square)](https://packagist.org/packages/boostphp/pipe-operator)
[![Total Downloads](https://img.shields.io/packagist/dt/boostphp/pipe-operator.svg?style=flat-square)](https://packagist.org/packages/boostphp/pipe-operator)

## Introduction

This package is based on the [pipe operator RFC by Sara Golemon and Marcelo Camargo (2016)](https://wiki.php.net/rfc/pipe-operator), who explains the problem as:

> A common PHP OOP pattern is the use of method chaining, or what is also known as “Fluent Expressions”. […] This works well enough for OOP classes which were designed for fluent calling, however it is impossible, or at least unnecessarily arduous, to adapt non-fluent classes to this usage style, harder still for functional interfaces.

### Short example

Say you want to get the subdomain from a URL, you may get quite verbose and repetitive code like this:

```php
$result = 'https://blog.github.com';
$result = parse_url($result);
$result = end($result);
$result = explode('.', $result);
$result = reset($result);

// blog
```

### More examples

See the [RFC by Golemon and Marcelo Camargo](https://wiki.php.net/rfc/pipe-operator) for more complex and real-world examples.

## Installation

You can install the package via Composer:

```bash
composer require boostphp/pipe-operator
```

## Usage

You could use the package like this:

```php
use Boost\PipeOperator\PipeOperator;

$result = (new PipeOperator('https://blog.github.com'))
    ->parse_url()
    ->end()
    ->explode('.', PIPED_VALUE)
    ->reset()
    ->get();

// blog
```

### Using closures

You could also use closures for more flexibility:

```php
use Boost\PipeOperator\PipeOperator;

$result = (new PipeOperator('https://blog.github.com'))
    ->pipe(fn ($value) => md5($value))
    ->pipe(fn ($value) => sprintf('prefixed-%s', $value))
    ->get();

// prefixed-740b375fe175853f9d4c5635194daf84
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
