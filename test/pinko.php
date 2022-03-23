<?php

use App\Pinko;

require __DIR__ . '/../vendor/autoload.php';

$Pinko = new Pinko;
$Pinko->register(require __DIR__ . '/commands.php');

$Pinko->run();
