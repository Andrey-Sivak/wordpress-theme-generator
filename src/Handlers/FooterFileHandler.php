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
declare(strict_types=1);
?>
<footer id="{$textDomain}-footer" class=""></footer>
PHP;
    }
}