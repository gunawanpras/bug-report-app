<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Exception/Exception.php';

// $config = \App\Helpers\Config::get('sdfsdf');
// $adb = new mysqli('abc', 'rrr', 'ddd');

$logger = new \App\Logger\Logger;
$logger->log(\App\Logger\LogLevel::EMERGENCY, 'There is an emergency', ['exception' => 'exception occured.']);
$logger->info("User account created successfully", ['id' => 'olkjSDfWIEFNzds']);