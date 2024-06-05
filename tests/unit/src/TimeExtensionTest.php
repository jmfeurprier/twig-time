<?php

namespace Jmf\Twig\Extension\Time;

use DateTime;
use Override;
use PHPUnit\Framework\TestCase;

class TimeExtensionTest extends TestCase
{
    private TimeExtension $extension;

    #[Override]
    protected function setUp(): void
    {
        $this->extension = new TimeExtension();
    }

    public function testIntlFormat(): void
    {
        $dateTime = new DateTime('2021-10-11 12:34:56');
        $format   = 'cccc';

        $result = $this->extension->intlFormat($dateTime, $format, 'fr_CA.UTF-8');

        $this->assertSame('lundi', $result);
    }

    public function testMicrotimeReturnsString(): void
    {
        $result = $this->extension->microtime(false);

        $this->assertIsString($result);
    }

    public function testMicrotimeReturnsFloat(): void
    {
        $result = $this->extension->microtime(true);

        $this->assertIsFloat($result);
    }
}
