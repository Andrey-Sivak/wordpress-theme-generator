<?php
declare(strict_types=1);

namespace WPTG\Handlers;

class FunctionsFileHandler implements FileHandler
{
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string
    {
        $textDomainUpper = strtoupper($textDomain);

        return <<<PHP
<?php
declare(strict_types=1);

/**
 * {$themeName} functions and definitions
 */

define('_{$textDomainUpper}_VERSION', '1.0.0');

function {$themeName}_setup(): void {
    // Make theme available for translation
    load_theme_textdomain('{$textDomain}', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', '{$textDomain}'),
        ),
    );

    // Switch core markup to HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ),
    );
}
add_action('after_setup_theme', '{$themeName}_setup');

function {$themeName}_get_ajax_url(): string {
    return get_template_directory_uri() . '/inc/front-ajax.php';
}

function {$themeName}_scripts(): void {
    \$ajax_url = {$themeName}_get_ajax_url();

    \${$themeName}_options = [
        'ajax_url' => \$ajax_url,
        'home_url' => get_home_url(),
    ];

    wp_dequeue_style('select2');
    wp_dequeue_script('select2');
    wp_deregister_script('select2');

    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');

    wp_enqueue_style('{$themeName}-style', get_stylesheet_uri(), array(), _{$textDomainUpper}_VERSION);
    wp_enqueue_style('{$themeName}-main-style', get_template_directory_uri() . '/dist/css/style.min.css', [], _{$textDomainUpper}_VERSION);
    wp_enqueue_style('{$themeName}-fonts-style', get_template_directory_uri() . '/fonts/{$themeName}-fonts.css', [], _{$textDomainUpper}_VERSION);

    wp_enqueue_script('{$themeName}-main-script', get_template_directory_uri() . '/dist/js/app.min.js', [], _{$textDomainUpper}_VERSION, true);
    wp_localize_script('{$themeName}-main-script', 'options', \${$themeName}_options);
}
add_action('wp_enqueue_scripts', '{$themeName}_scripts');
PHP;
    }
}