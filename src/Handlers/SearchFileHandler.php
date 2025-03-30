<?php
declare(strict_types=1);

namespace WPTG\Handlers;

class SearchFileHandler implements FileHandler {
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
    <header class="">
        <form class="">
            <button class="" type="submit"></button>
            <?php get_search_form(); ?>
        </form>
    </header>
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                get_template_part('/template-parts/post', 'card');
            endwhile;
        endif;
    ?>
</main>

<?php
get_footer();
PHP;
    }
}