<?php

interface DateTimeInterface
{
    public function diff(DateTimeInterface $datetime2, $absolute = false);

    /**
     * @return string
     */
    public function format($format);

    /**
     * @return integer
     */
    public function getOffset();
    public function getTimestamp();

    /**
     * @return DateTimeZone
     */
    public function getTimezone();

    /**
     * @return void
     */
    public function __wakeup();
}