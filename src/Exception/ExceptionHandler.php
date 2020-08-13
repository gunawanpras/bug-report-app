<?php
declare(strict_types = 1);
namespace App\Exception;

use App\Helpers\App;
use Throwable, ErrorException;

class ExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        $application = new App;

        if ($application->isDebugMode()) {
            print_r($exception);
        } else {
            echo 'This should not have happened, please try again' . PHP_EOL;
        }

        exit;
    }

    public function convertWarningsAndNoticesToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, 0, $severity,  $file, $line);
    }
}
