<?php
declare(strict_types=1);

namespace WPTG\Generators;

use InvalidArgumentException;
use ReflectionClass;
use RuntimeException;
use WPTG\Attributes\ThemeFile;
use WPTG\Dto\ThemeOptions;
use WPTG\Handlers\ComposerFileHandler;
use WPTG\Handlers\FooterFileHandler;
use WPTG\Handlers\HeaderFileHandler;
use WPTG\Handlers\LicenseFileHandler;
use WPTG\Handlers\PackageFileHandler;
use WPTG\Handlers\PhpcsFileHandler;
use WPTG\Handlers\StyleFileHandler;
use WPTG\Handlers\FunctionsFileHandler;

class ThemeGenerator
{
    #[ThemeFile(path: 'style.css', required: true)]
    #[ThemeFile(path: 'single.php', required: true)]
    #[ThemeFile(path: 'search.php', required: true)]
    #[ThemeFile(path: 'screenshot.png', required: false)]
    #[ThemeFile(path: 'readme.txt', required: false)]
    #[ThemeFile(path: 'README.md', required: false)]
    #[ThemeFile(path: 'phpcs.xml', required: false)]
    #[ThemeFile(path: 'page.php', required: true)]
    #[ThemeFile(path: 'package.json', required: false)]
    #[ThemeFile(path: 'LICENSE', required: false)]
    #[ThemeFile(path: 'index.php', required: true)]
    #[ThemeFile(path: 'header.php', required: true)]
    #[ThemeFile(path: 'gulpfile.js', required: false)]
    #[ThemeFile(path: 'functions.php', required: true)]
    #[ThemeFile(path: 'footer.php', required: true)]
    #[ThemeFile(path: 'composer.json', required: false)]
    #[ThemeFile(path: 'CHANGELOG.md', required: false)]
    #[ThemeFile(path: 'archive.php', required: true)]
    #[ThemeFile(path: '404.php', required: true)]
    #[ThemeFile(path: '.versionrc.json', required: false)]
    #[ThemeFile(path: '.stylelintrc.json', required: false)]
    #[ThemeFile(path: '.prettierrc', required: false)]
    #[ThemeFile(path: '.prettierrc.json', required: false)]
    #[ThemeFile(path: '.browserslistrc', required: false)]
    #[ThemeFile(path: '.prettierignore', required: false)]
    #[ThemeFile(path: '.gitignore', required: false)]
    #[ThemeFile(path: '.eslintrc', required: false)]
    #[ThemeFile(path: 'assets/img/t.txt', required: false)]
    #[ThemeFile(path: 'assets/js/app.js', required: false)]
    #[ThemeFile(path: 'assets/scss/style.scss', required: false)]
    #[ThemeFile(path: 'fonts/fonts.css', required: false)]
    #[ThemeFile(path: 'gulp/config/path.js', required: false)]
    #[ThemeFile(path: 'gulp/config/plugins.js', required: false)]
    #[ThemeFile(path: 'gulp/tasks/images.js', required: false)]
    #[ThemeFile(path: 'gulp/tasks/js.js', required: false)]
    #[ThemeFile(path: 'gulp/tasks/reset.js', required: false)]
    #[ThemeFile(path: 'gulp/tasks/scss.js', required: false)]
    #[ThemeFile(path: 'inc/front-ajax.php', required: false)]
    private const DUMMY_CONSTANT = 'placeholder';

    private array $fileHandlers = [];

    public function __construct(
        private string          $themesDir,
        private readonly string $templateDir = __DIR__ . '/../../templates/base/'
    )
    {
        $this->themesDir = rtrim($this->themesDir, '/') . '/';
        $this->fileHandlers = [
            'style.css' => new StyleFileHandler(),
            'functions.php' => new FunctionsFileHandler(),
            'header.php' => new HeaderFileHandler(),
            'footer.php' => new FooterFileHandler(),
            'phpcs.xml' => new PhpcsFileHandler(),
            'composer.json' => new ComposerFileHandler(),
            'package.json' => new PackageFileHandler(),
            'LICENSE' => new LicenseFileHandler(),
        ];
    }

    public function generate(
        string $themeName,
        string $themeSlug,
        string $themeDescription,
        string $textDomain
    ): void
    {
        $targetDir = $this->themesDir . $themeName;
        if (is_dir($targetDir)) {
            throw new \RuntimeException("A folder named '$themeSlug' already exists in 'themes/'.");
        }
        mkdir($targetDir, 0755, true) || throw new \RuntimeException("Failed to create directory '$targetDir'.");

        $reflection = new ReflectionClass(self::class);
        $attributes = $reflection->getReflectionConstant('DUMMY_CONSTANT')->getAttributes(ThemeFile::class);

        $options = new ThemeOptions($themeName, $themeSlug, $themeDescription, $textDomain);
        foreach ($attributes as $attribute) {
            $file = $attribute->newInstance();
            $source = $this->templateDir . $file->path . '.template';
            $dest = $targetDir . '/' . $file->path;
            $dir = dirname($dest);

            if (!is_dir($dir)) {
                mkdir($dir, 0755, true) || throw new RuntimeException("Failed to create directory '$dir'.");
            }

            if (isset($this->fileHandlers[$file->path])) {
                $handler = $this->fileHandlers[$file->path];
                $content = $handler->generateContent($options);
                file_put_contents($dest, $content) || throw new RuntimeException("Failed to write to '$dest'.");
            } elseif (file_exists($source)) {
                $content = file_get_contents($source);
                if (str_ends_with($file->path, '.php') && !str_contains($content, '/**')) {
                    $docblock = <<<PHP
<?php
/**
 * Template file for {$file->path}
 *
 * This file is part of the {$themeName} theme.
 *
 * @package {$themeName}
 */
 
declare(strict_types=1);
PHP;
                    $content = $docblock . substr($content, strpos($content, "\n") + 1);
                }
                file_put_contents($dest, $content) || throw new \RuntimeException("Failed to write to '$dest'.");
            } else {
                touch($dest) || throw new RuntimeException("Failed to create file '$dest'.");
            }
        }
    }
}