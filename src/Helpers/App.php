<?php

namespace App\Helpers;

use DateTimeInterface, DateTime, DateTimeZone;
use App\Helpers\Config;

class App
{
    private $config = [];

    public function __construct()
    {
        $this->config = Config::get('app');
    }

    public function isDebugMode(): bool
    {
        if (! isset($this->config['debug'])) {
            return false;
        }

        return $this->config['debug'];
    }

    public function getEnvironment(): string
    {
        if (! isset($this->config['env'])) {
            return 'production';
        } else if ($this->isTestMode()) {
            return 'test';
        }

        return $this->config['env'];
    }

    public function getLogPath()
    {
        if (! isset($this->config['log_path'])) {
            throw new \Exception("Log path is not defined");
            
        }

        return $this->config['log_path'];
    }

    public function isRunningFromConsole(): bool
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpbg';
    }

    public function getServerTime(): DateTimeInterface
    {
        return new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    }

    public function isTestMode()
    {
        if ($this->isRunningFromConsole() && defined('PHPUNIT_RUNNING') && constant('PHPUNIT_RUNNING') === true) {
            return true;
        }

        return false;
    }
}
