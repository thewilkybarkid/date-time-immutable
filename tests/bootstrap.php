<?php

/*
 * This file is part of the DateTimeImmutable polyfill library.
 *
 * (c) Chris Wilkinson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$loader = @include __DIR__ . '/../vendor/autoload.php';

if (false === $loader) {
    die(<<<'EOT'
You must set up the project dependencies by running the following commands:

    curl -s http://getcomposer.org/installer | php
    php composer.phar install --dev

EOT
    );
}
