<?php
declare(strict_types=1);

namespace WPTG\Handlers;

interface FileHandler
{
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string;
}