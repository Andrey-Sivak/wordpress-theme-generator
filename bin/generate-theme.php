<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use WPTG\Generators\ThemeGenerator;
use WPTG\Utils\CliHelper;

try {
    $themesDir = __DIR__ . '/../themes/';
    is_dir($themesDir) || mkdir($themesDir, 0755, true) || throw new RuntimeException("Failed to create themes directory.");

    $themeName = CliHelper::prompt("Enter the theme name: ");
    $themeDescription = CliHelper::prompt("Enter the theme description: ");
    $textDomain = CliHelper::prompt("Enter the text domain (e.g., {$themeName}): ");

    $generator = new ThemeGenerator(themesDir: $themesDir);
    $generator->generate($themeName, $themeDescription, $textDomain);

    echo "Theme '$themeName' generated successfully!\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}