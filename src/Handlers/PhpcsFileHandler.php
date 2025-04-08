<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Dto\ThemeOptions;

class PhpcsFileHandler implements FileHandler
{
    public function generateContent(ThemeOptions $options): string
    {
        return <<<XML
<?xml version="1.0"?>
<ruleset name="{$options->themeName} Standards">
    <description>Coding standards for {$options->themeName} theme</description>

    <!-- Show progress and sniff codes -->
    <arg value="ps"/>

    <!-- Exclude non-PHP or third-party directories -->
    <exclude-pattern>*/\.github/*</exclude-pattern>
    <exclude-pattern>*/assets/*</exclude-pattern>
    <exclude-pattern>*/dist/*</exclude-pattern>
    <exclude-pattern>*/languages/*</exclude-pattern>
    <exclude-pattern>*/vector-images/*</exclude-pattern>
    <exclude-pattern>*\.mo</exclude-pattern>
	<exclude-pattern>*\.po</exclude-pattern>
    <exclude-pattern>*/fonts/*</exclude-pattern>
    <exclude-pattern>*/vendor/*</exclude-pattern>
    <exclude-pattern>*/node-modules/*</exclude-pattern>
    <exclude-pattern>front-ajax.php</exclude-pattern>

    <!-- Set PHP and WP version compatibility -->
    <config name="testVersion" value="8.3-"/>
    <config name="minimum_supported_wp_version" value="6.4"/>

    <!-- Use full WordPress Coding Standards -->
    <rule ref="WordPress"/>

    <!-- Enforce text domain for i18n -->
    <rule ref="WordPress.WP.I18n">
        <properties>
            <property name="text_domain" value="{$options->textDomain}"/>
        </properties>
    </rule>
</ruleset>
XML;
    }
}