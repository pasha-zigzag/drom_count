<?php
$dir = './';

function getCountSum($dir) : int
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $sum = 0;

    foreach ($iterator as $path) {
        if(is_file($path->getPathName()) && $path->getFileName() === 'count') {
            $count = fopen($path->getPathName(), 'r');
            while($line = fgets($count)) {
                $number = intval($line);
                $sum += $number;
            }

            fclose($count);
        }
    }

    return $sum;
}

echo getCountSum($dir);