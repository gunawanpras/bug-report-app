<?php
namespace Tests\Units;

use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgumentException;
use App\Helpers\App;
use App\Logger\Logger;
use App\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @var Logger $logger
     */
    private $logger;

    public function setUp(): void
    {
        $this->logger = new Logger;
        parent::setUp();
    }

    public function testItImplementsLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    public function testItCanCreateDifferentTypesOfLogLevel()
    {
        $this->logger->info('Testing info logs');
        $this->logger->error('Testing error logs');
        $this->logger->log(LogLevel::EMERGENCY, 'Testing emergency logs');

        $app = new App;

        $fileName = sprintf("%s/%s-%s.log", $app->getlogPath(), 'test', date("j.n.Y"));
        self::assertFileExists($fileName);

        $logFile = file_get_contents($fileName);
        self::assertStringContainsString('Testing info logs', $logFile);
        self::assertStringContainsString('Testing error logs', $logFile);
        self::assertStringContainsString('Testing emergency logs', $logFile);
        unlink($fileName);
        self::assertFileNotExists($fileName);
    }

    public function testItThrowsInvalidLogLevelArgumentExceptionWhenGivingAWrongLogLevel()
    {
        $this->expectException(InvalidLogLevelArgumentException::class);
        $this->logger->log('dsfa', 'It is invalid log level');
    }
}
