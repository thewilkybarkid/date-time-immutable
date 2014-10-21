<?php

/*
 * This file is part of the DateTimeImmutable polyfill library.
 *
 * (c) Chris Wilkinson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class DateTimeImmutable extends DateTime
{
    /**
     * To prevent infinite recursions
     *
     * @var boolean
     */
    private static $_immutable = true;

    /**
     * Returns new DateTimeImmutable object formatted according to the specified format.
     *
     * @link http://php.net/manual/en/datetimeimmutable.createfromformat.php
     *
     * @param string            $format
     * @param string            $time
     * @param DateTimeZone|null $timezone
     *
     * @return DateTimeImmutable|false
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        $parent = parent::createFromFormat($format, $time);

        if (false === $parent instanceof DateTime) {
            return false;
        }

        return new static($parent->format(DateTime::ISO8601));
    }

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds.
     *
     * @link http://php.net/manual/en/datetimeimmutable.add.php
     *
     * @param DateInterval $interval
     *
     * @return DateTimeImmutable
     */
    public function add($interval)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->add($interval);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::add($interval);
        }
    }

    /**
     * Creates a new object with modified timestamp.
     *
     * @link http://php.net/manual/en/datetimeimmutable.modify.php
     *
     * @param string $modify
     *
     * @return DateTimeImmutable|false
     */
    public function modify($modify)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->modify($modify);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::modify($modify);
        }
    }

    /**
     * Subtracts an amount of days, months, years, hours, minutes and seconds.
     *
     * @link http://php.net/manual/en/datetimeimmutable.sub.php
     *
     * @param DateInterval $interval
     *
     * @return DateTimeImmutable
     */
    public function sub($interval)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->sub($interval);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::sub($interval);
        }
    }

    /**
     * Sets the date.
     *
     * @link http://php.net/manual/en/datetimeimmutable.setdate.php
     *
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return DateTimeImmutable
     */
    public function setDate($year, $month, $day)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->setDate($year, $month, $day);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::setDate($year, $month, $day);
        }
    }

    /**
     * Sets the ISO date.
     *
     * @link http://php.net/manual/en/datetimeimmutable.setisodate.php
     *
     * @param int      $year
     * @param int      $week
     * @param int|null $day
     *
     * @return DateTimeImmutable
     */
    public function setISODate($year, $week, $day = null)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->setISODate($year, $week, $day);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::setISODate($year, $week, $day);
        }
    }

    /**
     * Sets the time.
     *
     * @link http://php.net/manual/en/datetimeimmutable.settime.php
     *
     * @param int      $hour
     * @param int      $minute
     * @param int|null $second
     *
     * @return DateTimeImmutable
     */
    public function setTime($hour, $minute, $second = null)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->setTime($hour, $minute, $second);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::setTime($hour, $minute, $second);
        }
    }

    /**
     * Sets the date and time based on an Unix timestamp.
     *
     * @link http://php.net/manual/en/datetimeimmutable.settimestamp.php
     *
     * @param int $timestamp
     *
     * @return DateTimeImmutable
     */
    public function setTimestamp($timestamp)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->setTimestamp($timestamp);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::setTimestamp($timestamp);
        }
    }

    /**
     * Sets the time zone.
     *
     * @link http://php.net/manual/en/datetimeimmutable.settimezone.php
     *
     * @param DateTimeZone $timezone
     *
     * @return DateTimeImmutable
     */
    public function setTimezone($timezone)
    {
        if (self::$_immutable) {
            self::$_immutable = false;
            $newDate = clone $this;
            $newDate->setTimezone($timezone);
            self::$_immutable = true;

            return $newDate;
        } else {
            return parent::setTimezone($timezone);
        }
    }
}
