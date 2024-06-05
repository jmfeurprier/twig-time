<?php

namespace Jmf\Twig\Extension\Time;

use DateTimeInterface;
use IntlCalendar;
use IntlDateFormatter;
use Jmf\Twig\Extension\Time\Exception\TimeException;
use Override;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TimeExtension extends AbstractExtension
{
    public final const string PREFIX_DEFAULT = '';

    public function __construct(
        private readonly ?string $locale = null,
        private readonly string $functionPrefix = self::PREFIX_DEFAULT,
    ) {
    }

    #[Override]
    public function getFilters(): iterable
    {
        return [
            new TwigFilter(
                "{$this->functionPrefix}intl_format",
                $this->intlFormat(...),
            ),
        ];
    }

    #[Override]
    public function getFunctions(): iterable
    {
        return [
            new TwigFunction(
                "{$this->functionPrefix}microtime",
                $this->microtime(...),
            ),
        ];
    }

    /**
     * @param string[]|int|string|null $format
     *
     * @throws TimeException
     */
    public function intlFormat(
        IntlCalendar | DateTimeInterface $value,
        array | int | string | null $format = null,
        ?string $locale = null
    ): string {
        $this->assertIntlPhpExtensionInstalled();

        $locale ??= $this->locale;
        $result = IntlDateFormatter::formatObject($value, $format, $locale);

        if (false === $result) {
            throw new TimeException('Failed to format date and time.');
        }

        return $result;
    }

    /**
     * @throws TimeException
     */
    private function assertIntlPhpExtensionInstalled(): void
    {
        if (!extension_loaded('intl')) {
            throw new TimeException('PHP intl extension must be installed.');
        }
    }

    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function microtime(bool $asFloat = false): string | float
    {
        return microtime($asFloat);
    }
}
