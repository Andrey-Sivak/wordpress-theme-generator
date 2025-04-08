<?php
declare(strict_types=1);

namespace WPTG\Handlers;

use WPTG\Dto\ThemeOptions;

class LicenseFileHandler implements FileHandler
{
    public function generateContent(ThemeOptions $options): string
    {
        return <<<TEXT
GNU GENERAL PUBLIC LICENSE
Version 2, June 1991

Copyright (C) 2025 Andrey-Sivak

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.

---

{$options->themeName} WordPress Theme
Copyright (C) 2025 Andrey-Sivak

This theme, including all PHP, JavaScript, CSS, and other files, is licensed under the GNU General Public License (GPL) version 2 or later. You are free to use, modify, and distribute this theme under the terms of the GPL.

For more information, see <https://www.gnu.org/licenses/gpl-2.0.html>.
TEXT;
    }
}