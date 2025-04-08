<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Config\Config;
use WPTG\Dto\ThemeOptions;

class StyleFileHandler implements FileHandler
{
    public function generateContent(ThemeOptions $options): string
    {
        $authorGithubUrl = Config::AUTHOR_GITHUB_URL;
        $authorName = Config::AUTHOR_NAME;

        return <<<CSS
/*!
Theme Name: {$options->themeName}
Theme URI: {$authorGithubUrl}/{$options->themeSlug}
Author: {$authorName}
Author URI: {$authorGithubUrl}
Description: {$options->themeDescription}
Version: 1.0.0
Tested up to: 7.4
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: {$options->textDomain}
*/
CSS;
    }
}