<?php

interface DateTimeInterface
{
    public function diff(DateTimeInterface $datetime2, $absolute = false);
    public function format($format);
    public function getOffset();
    public function getTimestamp();
    public function getTimezone();
    public function __wakeup();
}