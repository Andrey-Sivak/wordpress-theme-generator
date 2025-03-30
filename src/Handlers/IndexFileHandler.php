<?php
declare(strict_types=1);

namespace WPTG\Handlers;

class IndexFileHandler implements FileHandler {
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string {
        return <<<PHP
<?php
declare(strict_types=1);

get_header();
?>

<main class="site-main">
<?php
	while ( have_posts() ) :
	    the_post();
	    get_template_part('/template-parts/post', 'card');
    endwhile;
?>
</main>

<?php
get_footer();
PHP;
    }
}