<?php

require __DIR__ . '/vendor/autoload.php';

try {
    (new \Src\Main())->run();
} catch (\Exception $e) {
    echo $e->getMessage();
}