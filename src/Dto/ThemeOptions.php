<?php
declare(strict_types=1);

namespace WPTG\Dto;

readonly class ThemeOptions {
    public function __construct(
        public string $themeName,
        public string $themeSlug,
        public string $themeDescription,
        public string $textDomain,
        public array  $extra = []
    ) {}
}