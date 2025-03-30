<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Config\Config;

class StyleFileHandler implements FileHandler {
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string {
        $authorGithubUrl = Config::AUTHOR_GITHUB_URL;
        $authorName = Config::AUTHOR_NAME;

        return <<<CSS
/*!
Theme Name: {$themeName}
Theme URI: {$authorGithubUrl}/{$themeName}
Author: {$authorName}
Author URI: {$authorGithubUrl}
Description: {$themeDescription}
Version: 1.0.0
Tested up to: 7.4
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: {$textDomain}
*/
CSS;
    }
}