<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Dto\ThemeOptions;

class FooterFileHandler implements FileHandler
{
    public function generateContent(ThemeOptions $options): string
    {
        return <<<PHP
<?php
/**
 * The footer template for the {$options->themeName} theme
 *
 * This file contains the closing body and HTML tags, along with footer content
 * such as widgets, copyright info, and scripts. It is included via get_footer().
 *
 * @package {$options->themeName}
 */
 
declare(strict_types=1);
?>
<footer id="{$options->textDomain}-footer" class="{$options->themeSlug}__footer"></footer>

<?php wp_footer(); ?>

</body>
</html>
PHP;
    }
}