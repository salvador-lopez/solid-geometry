#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/../vendor/autoload.php';

use SolidGeometry\Infrastructure\Presentation\Console\CalculateBoxOverlapVolumeCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new CalculateBoxOverlapVolumeCommand());

$application->run();
