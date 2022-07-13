<?php

namespace Juampi92\Phecks\Application\Formatters;

use Juampi92\Phecks\Application\Contracts\Formatter;
use RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FormatResolver
{
    public const FORMATTERS = [
        'console' => ConsoleFormatter::class,
    ];

    public const DEFAULT_FORMATTER = ConsoleFormatter::class;

    /**
     * @param string|mixed $formatter
     */
    public static function resolve(
        $formatter,
        InputInterface $input,
        OutputInterface $output
    ): Formatter {
        if (!is_string($formatter) || !isset(static::FORMATTERS[$formatter])) {
            throw new RuntimeException(sprintf(
                "The specified formatter '%s' is not supported. Use any of: %s",
                $formatter,
                implode(', ', array_keys(static::FORMATTERS)),
            ));
        }

        return resolve(
            static::FORMATTERS[$formatter] ?? static::DEFAULT_FORMATTER,
            ['input' => $input, 'output' => $output],
        );
    }
}
