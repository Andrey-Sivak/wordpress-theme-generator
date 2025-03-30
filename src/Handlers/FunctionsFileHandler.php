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
/**
 * Theme functions and definitions
 *
 * This file sets up the theme by registering features, enqueuing assets, and defining
 * utility functions. It is loaded automatically by WordPress on every page load.
 *
 * @package {$themeName}
 */
 
declare(strict_types=1);

/**
 * The {$themeName} functions and definitions
 */

define('_{$textDomainUpper}_VERSION', '1.0.0');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function {$themeName}_setup(): void {
	// Make theme available for translation.
	load_theme_textdomain( '{$textDomain}', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', '{$textDomain}' ),
		),
	);

	// Switch core markup to HTML5.
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

/**
 * Get ajax url
 *
 * @return string
 */
function {$themeName}_get_ajax_url(): string {
	return get_template_directory_uri() . '/inc/front-ajax.php';
}

/**
 * Enqueue scripts and styles.
 */
function {$themeName}_scripts(): void {
	\$ajax_url = {$themeName}_get_ajax_url();

	\${$themeName}_options = array(
		'ajax_url' => \$ajax_url,
		'home_url' => get_home_url(),
	);

	wp_dequeue_style( 'select2' );
	wp_dequeue_script( 'select2' );
	wp_deregister_script( 'select2' );

	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );

	wp_enqueue_style( '{$themeName}-style', get_stylesheet_uri(), array(), _{$textDomainUpper}_VERSION );
	wp_enqueue_style( '{$themeName}-main-style', get_template_directory_uri() . '/dist/css/style.min.css', array(), _{$textDomainUpper}_VERSION );
	wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/fonts/fonts.css', array(), _{$textDomainUpper}_VERSION );

    \$manifest_path = get_template_directory() . '/dist/js/manifest.json';

    if ( file_exists( \$manifest_path ) ) {
        \$manifest = json_decode( file_get_contents( \$manifest_path ), true );

        if ( is_array( \$manifest ) && !empty( \$manifest ) ) {
            foreach ( \$manifest as \$file ) {
                if ( str_contains( \$file, '.js' ) ) {
                    \$chunk_handle = 'app-chunk-' . basename( \$file, '.js' );
                    \$chunk_handle = str_replace( '.chunk', '', \$chunk_handle );

                    wp_enqueue_script( \$chunk_handle, get_template_directory_uri() . \$file, array(), _{$textDomainUpper}_VERSION, true );

                    if ( str_contains( \$file, 'app.min.js' ) ) {
                        wp_localize_script( \$chunk_handle, 'options', \${$themeName}_options );
                    }
                }
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', '{$themeName}_scripts' );
PHP;
    }
}