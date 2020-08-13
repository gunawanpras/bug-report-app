<?php
declare(strict_types = 1);

set_error_handler([
    new \App\Exception\ExceptionHandler(), 'convertWarningsAndNoticesToException'
]);

set_exception_handler([
    new \App\Exception\ExceptionHandler(), 'handle'
]);