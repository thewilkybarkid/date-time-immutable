<?php

/*
 * This file is part of the DateTimeImmutable polyfill library.
 *
 * (c) Chris Wilkinson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit_Framework_TestCase as TestCase;

class DateTimeImmutableTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf('DateTimeInterface', new DateTimeImmutable());
    }

    public function testInstantiateWithoutTimeZone()
    {
        new DateTimeImmutable();
        new DateTimeImmutable("+1 day");
    }

    public function testCreateFromFormat()
    {
        $time = '2000-01-02T03:14:25Z';

        $immutable = DateTimeImmutable::createFromFormat(DateTime::RFC3339, $time);
        $mutable = DateTime::createFromFormat(DateTime::RFC3339, $time);

        $this->assertInstanceOf('DateTimeImmutable', $immutable);
        $this->assertSame($mutable->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
    }

    public function testCreateFromFormatWithTimezone()
    {
        $time = '2000-01-02 03:14:25';

        if ('Europe/London' === date_default_timezone_get()) {
            $timezone = new DateTimeZone('America/Los_Angeles');
        } else {
            $timezone = new DateTimeZone('Europe/London');
        }

        $immutable = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $time, $timezone);
        $mutable = DateTime::createFromFormat('Y-m-d H:i:s', $time, $timezone);

        $this->assertInstanceOf('DateTimeImmutable', $immutable);
        $this->assertSame($mutable->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
    }

    public function testCreateFromFormatFailure()
    {
        $time = 'foo';

        $immutable = DateTimeImmutable::createFromFormat(DateTime::RFC3339, $time);
        $mutable = DateTime::createFromFormat(DateTime::RFC3339, $time);

        $this->assertFalse($immutable);
        $this->assertSame(DateTime::getLastErrors(), DateTimeImmutable::getLastErrors());
    }

    public function testAdd()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $interval = new DateInterval('P1D');

        $new = $immutable->add($interval);
        $mutable->add($interval);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testModify()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $new = $immutable->modify('+1 day');
        $mutable->modify('+1 day');

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testSub()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $interval = new DateInterval('P1D');

        $new = $immutable->sub($interval);
        $mutable->sub($interval);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testSetDate()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $new = $immutable->setDate(2005, 10, 20);
        $mutable->setDate(2005, 10, 20);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testSetISODate()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $new = $immutable->setISODate(2005, 10, 5);
        $mutable->setISODate(2005, 10, 5);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testSetTime()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $new = $immutable->setTime(2005, 10, 5);
        $mutable->setTime(2005, 10, 5);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testSetTimestamp()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $new = $immutable->setTimestamp(1272508903);
        $mutable->setTimestamp(1272508903);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }

    public function testSetTimezone()
    {
        $time = '2000-01-02T03:14:25';

        $immutable = new DateTimeImmutable($time);
        $control = new DateTimeImmutable($time);
        $mutable = new DateTime($time);

        $timezone = new DateTimeZone('Pacific/Nauru');

        $new = $immutable->setTimezone($timezone);
        $mutable->setTimezone($timezone);

        $this->assertNotSame($immutable, $new);
        $this->assertSame($control->format(DateTime::RFC3339), $immutable->format(DateTime::RFC3339));
        $this->assertSame($mutable->format(DateTime::RFC3339), $new->format(DateTime::RFC3339));
    }
}
