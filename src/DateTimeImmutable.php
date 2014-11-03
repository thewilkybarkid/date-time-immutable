<?php

/*
 * This file is part of the DateTimeImmutable polyfill library.
 *
 * (c) Chris Wilkinson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class DateTimeImmutable implements DateTimeInterface
{
    /**
     * @var DateTime
     */
    private $dt;

    public function __construct($time = "now", $timezone = null)
    {
        if($time instanceof DateTime) {
            $this->dt = clone($time);
        } elseif(is_null($timezone)) {
            $this->dt = new DateTime($time);
        } else {
            $this->dt = new DateTime($time, $timezone);
        }
    }

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
        $dt = is_null($timezone)
            ? DateTime::createFromFormat($format, $time)
            : DateTime::createFromFormat($format, $time, $timezone);

        if(!$dt instanceof DateTime) {
            return false;
        }

        return new static($dt);
    }

    public static function createFromMutable(DateTime $datetime)
    {
        return new static($datetime);
    }

    public static function getLastErrors()
    {
        return date_get_last_errors();
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
    public function add(DateInterval $interval)
    {
        return $this->mutate(
            function(DateTime $dt) use ($interval) {
                $dt->add($interval);
            }
        );
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
        return $this->mutate(
            function(DateTime $dt) use ($modify) {
                $dt->modify($modify);
            }
        );
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
        return $this->mutate(
            function(DateTime $dt) use ($interval) {
                $dt->sub($interval);
            }
        );
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
        return $this->mutate(
            function(DateTime $dt) use ($year, $month, $day) {
                $dt->setDate($year, $month, $day);
            }
        );
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
        return $this->mutate(
            function(DateTime $dt) use ($year, $week, $day) {
                $dt->setISODate($year, $week, $day);
            }
        );
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
        return $this->mutate(
            function(DateTime $dt) use ($hour, $minute, $second) {
                $dt->setTime($hour, $minute, $second);
            }
        );
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
        return $this->mutate(
            function(DateTime $dt) use ($timestamp) {
                $dt->setTimestamp($timestamp);
            }
        );
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
    public function setTimezone(DateTimeZone $timezone)
    {
        return $this->mutate(
            function(DateTime $dt) use ($timezone) {
                $dt->setTimezone($timezone);
            }
        );
    }

    public function diff(DateTimeInterface $datetime2, $absolute = false)
    {
        return $this->dt->diff($datetime2, $absolute);
    }

    public function format($format)
    {
        return $this->dt->format($format);
    }

    public function getOffset()
    {
        return $this->dt->getOffset();
    }

    public function getTimestamp()
    {
        return $this->dt->getTimestamp();
    }

    public function getTimezone()
    {
        return $this->dt->getTimezone();
    }

    public function __wakeup()
    {
        // nothing to do, $this->dt takes care of itself
    }

    private function mutate($mutation)
    {
        $newDateTimeImmutable = new static($this->dt);
        $mutation($newDateTimeImmutable->dt);
        return $newDateTimeImmutable;
    }
}
