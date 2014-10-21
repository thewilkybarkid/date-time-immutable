`DateTimeImmutable` polyfill
============================

[![Build Status](https://travis-ci.org/thewilkybarkid/date-time-immutable.png?branch=master)](https://travis-ci.org/thewilkybarkid/date-time-immutable)

This small library adds a polyfill for the `DateTimeImmutable` object introduced in PHP 5.5.0.

Authors
-------

* Chris Wilkinson

It's partially based on Benjamin Eberlei's [Immutable DateTime Objects](http://www.whitewashing.de/2010/01/08/immutable-datetime-objects.html) blog post.

Installation
------------

    $ php composer.phar require thewilkybarkid/date-time-immutable:~1.0

Basic usage
-----------

    $dateTime = new DateTimeImmutable();
    $newDateTime = $datetime->modify('+1 day');
    var_dump($dateTime === $newDateTime); // output 'bool(false)'

Caveats
-------

PHP 5.5.0 also introduced a `DateTimeInterface` which both `DateTimeImmutable` and `DateTime` implement. In this polyfill we can't change the `DateTime` class, so `DateTimeImmutable` has to extend it. This is slightly dangerous as their behaviour is not compatible (see <https://bugs.php.net/bug.php?id=64513>).

PHP 5.6.0 added a `DateTimeImmutable::createFromMutable()` factory method, which this polyfill doesn't include.
