<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Config\Config;
use WPTG\Dto\ThemeOptions;

class ComposerFileHandler implements FileHandler
{
    public function generateContent(ThemeOptions $options): string
    {
        $authorName = Config::AUTHOR_NAME;
        $lowerAuthorName = strtolower($authorName);
        $json = [
            'name' => "{$lowerAuthorName}/{$options->themeSlug}",
            'description' => $options->themeDescription,
            'type' => 'wordpress-theme',
            'license' => 'GPL-2.0-or-later',
            'authors' => [
                [
                    'name' => $authorName,
                    'homepage' => Config::AUTHOR_GITHUB_URL . '/' . $options->themeSlug,
                ],
            ],
            'require' => [
                'php' => '>=8.3',
                'squizlabs/php_codesniffer' => '^3.7',
                'wp-coding-standards/wpcs' => '^3.0',
            ],
            'require-dev' => [
                'dealerdirect/phpcodesniffer-composer-installer' => '^1.0',
            ],
            'config' => [
                'platform' => [
                    'php' => '8.3',
                ],
            ],
            'scripts' => [
                'post-install-cmd' => [
                    '"vendor/bin/phpcs" --config-set installed_paths vendor/wp-coding-standards/wpcs,vendor/phpcsstandards/phpcsutils,vendor/phpcsstandards/phpcsextra',
                ],
                'post-update-cmd' => [
                    '"vendor/bin/phpcs" --config-set installed_paths vendor/wp-coding-standards/wpcs,vendor/phpcsstandards/phpcsutils,vendor/phpcsstandards/phpcsextra',
                ],
                'lint' => '"vendor/bin/phpcs" --standard=phpcs.xml .',
                'fix' => '"vendor/bin/phpcbf" --standard=phpcs.xml .',
            ],
        ];

        return json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}