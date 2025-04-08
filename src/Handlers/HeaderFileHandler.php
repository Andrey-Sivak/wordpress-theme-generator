<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Dto\ThemeOptions;

class HeaderFileHandler implements FileHandler
{
    public function generateContent(ThemeOptions $options): string
    {
        return <<<PHP
<?php
/**
 * The header template for the theme
 *
 * This file contains the HTML head section, opening body tag, and top-level site markup
 * such as the site header and navigation. It is included in all front-end pages via get_header().
 *
 * @package {$options->themeName}
 */
 
declare(strict_types=1);

\${$options->themeSlug}_body_class = '';
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class( \${$options->themeSlug}_body_class ); ?>>
<?php wp_body_open(); ?>
	<header id="ew-header" class=""></header>
PHP;
    }
}