<?php

require 'CountFinder.php';

$countFinder = new CountFinder('./', '');

try {
    $countFinder->calculateCountSum();
} catch (Exception $e) {
    die($e->getMessage());
}

echo $countFinder->getCountSum();