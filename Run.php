<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $GLOBALS['lang'] = 'en';

    (new \Src\Main())->run();
} catch (\Exception $e) {
    echo $e->getMessage();
}