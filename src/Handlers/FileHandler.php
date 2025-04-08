<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Dto\ThemeOptions;

interface FileHandler {
    public function generateContent(ThemeOptions $options): string;
}