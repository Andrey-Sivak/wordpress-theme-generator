<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Config\Config;

class PackageFileHandler implements FileHandler {
    public function generateContent(
        string $themeName,
        string $themeDescription,
        string $textDomain
    ): string {
        $authorName = Config::AUTHOR_NAME;
        $authorGithubUrl = Config::AUTHOR_GITHUB_URL;

        $json = [
            'name' => $themeName,
            'version' => '1.0.0',
            'description' => $themeDescription,
            'main' => 'gulpfile.js',
            'type' => 'module',
            'author' => "{$authorName} && Contributors",
            'license' => 'GPL-2.0-or-later',
            'keywords' => [
                'WordPress',
                'Theme',
            ],
            'homepage' => "{$authorGithubUrl}/{$themeName}#readme",
            'repository' => [
                'type' => 'git',
                'url' => "git+{$authorGithubUrl}/{$themeName}.git",
            ],
            'bugs' => [
                'url' => "{$authorGithubUrl}/{$themeName}/issues",
            ],
            'scripts' => [
                'dev' => 'gulp',
                'build' => 'gulp build --build',
            ],
            'devDependencies' => [
                '@babel/core' => '^7.26.10',
                '@babel/eslint-parser' => '^7.26.10',
                '@babel/preset-env' => '^7.26.9',
                '@tailwindcss/postcss' => '^4.0.14',
                '@wordpress/scripts' => "^30.13.0",
                'autoprefixer' => '^10.4.21',
                'babel-loader' => '^10.0.0',
                'css-loader' => '^7.1.2',
                'cssnano' => '^7.0.6',
                'del' => '^8.0.0',
                'eslint' => '^9.22.0',
//                'eslint-config-prettier' => '^10.1.1',
                'eslint-plugin-prettier' => '^5.2.3',
                'eslint-webpack-plugin' => '^5.0.0',
                'gulp' => '^5.0.0',
                'gulp-babel' => '^8.0.0',
                'gulp-if' => '^3.0.0',
                'gulp-newer' => '^1.4.0',
                'gulp-notify' => '^5.0.0',
                'gulp-plumber' => '^1.2.1',
                'gulp-postcss' => '^10.0.0',
                'gulp-rename' => '^2.0.0',
                'gulp-sass' => '^6.0.1',
                'gulp-util' => '^3.0.8',
//                'gulp-webp-html-nosvg' => '^1.1.1',
                'node-sass' => '^9.0.0',
//                'package-json-to-wordpress-style-css' => '^1.0.6',
                'pkginfo' => '^0.4.1',
                'postcss' => '^8.5.3',
                'postcss-import' => '^16.1.0',
                'prettier' => '^3.5.3',
                'sass' => '^1.86.0',
                'sass-loader' => '^16.0.5',
                'standard-version' => '^9.5.0',
                'style-loader' => '^4.0.0',
                'tailwindcss' => '^4.0.14',
                'terser-webpack-plugin' => '^5.3.14',
                'webpack' => '^5.98.0',
                'webpack-stream' => '^7.0.0',
                'gulp-cached' => '^1.1.1',
                'gulp-clone' => '^2.0.1',
                'webpack-manifest-plugin' => '^5.0.1',
            ],
            'dependencies' => [],
        ];

        return json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}