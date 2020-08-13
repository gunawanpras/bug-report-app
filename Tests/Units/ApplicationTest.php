<?php

namespace Tests\Units;

use App\Helpers\App;
use PHPUnit\Framework\TestCase;

// class name must contain word 'Test'
class ApplicationTest extends TestCase
{
    // method name must contain word 'test'
    // nama method harus sangat deskriptif terhadap scenario yang akan dijalankan
    public function testItCanGetInstanceOfApplication()
    {
        // nama class harus FQN
        self::assertInstanceOf(App::class, new App);
    }

    public function testItCanGetBasicApplicationDatasetFromApp()
    {
        $application = new App;
        self::assertTrue($application->isRunningFromConsole());
        self::assertSame('test', $application->getEnvironment());
        self::assertNotNull($application->getLogPath());
        self::assertInstanceOf(\DateTime::class, $application->getServerTime());
    }
}
