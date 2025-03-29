<?php
declare(strict_types=1);

namespace WPTG\Utils;

class CliHelper
{
    public static function prompt(string $message): string
    {
        echo $message;
        return trim(fgets(STDIN));
    }
}