<?php
declare(strict_types=1);

namespace WPTG\Handlers;

class HeaderFileHandler implements FileHandler {
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string {
        return <<<PHP
<?php
declare(strict_types=1);

\${$themeName}_body_class = '';
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>
<body <?php body_class(\${$themeName}_body_class); ?>>
<?php wp_body_open(); ?>
     <header id="{$textDomain}-header" class=""></header>
PHP;
    }
}