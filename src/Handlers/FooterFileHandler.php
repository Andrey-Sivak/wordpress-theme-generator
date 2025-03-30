<?php
declare(strict_types=1);

namespace WPTG\Handlers;

class FooterFileHandler implements FileHandler {
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string {
        return <<<PHP
<?php
/**
 * The footer template for the theme
 *
 * This file contains the closing body and HTML tags, along with footer content
 * such as widgets, copyright info, and scripts. It is included via get_footer().
 *
 * @package {themeName}
 */
 
declare(strict_types=1);
?>
<footer id="{$textDomain}-footer" class=""></footer>
PHP;
    }
}