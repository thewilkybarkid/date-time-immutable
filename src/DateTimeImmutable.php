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
     * @var bool
     */
    private static $_immutable = true;

    public static function createFromFormat($format, $time, $timezone = null)
    {
        return new static(parent::createFromFormat($format, $time)->format(DateTime::ISO8601));
    }

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
