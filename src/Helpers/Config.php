<?php
declare(strict_types = 1);

namespace App\Helpers;

use App\Exception\NotFoundException;

class Config
{
    public static function get($filename, $key = null)
    {
        $config = self::getConfig($filename);
        if ($key) {
            if (isset($config[$key])) {
                return $config[$key];
            }
            
            return '';
        }

        return $config;
    }
    public static function getConfig(string $filename): array
    {
        $configs = [];
        try {
            $path = realpath(sprintf(__DIR__ . '/../Configs/%s.php', $filename));
            if (file_exists ($path)) {
                $configs = require $path;
            }
        } catch(\Throwable $e) {
            throw new NotFoundException(
                sprintf('The specified file: \'%s\' was not found', $filename), ['not found file', 'data is passed']
            );
            
        }

        return $configs;
    }
}
