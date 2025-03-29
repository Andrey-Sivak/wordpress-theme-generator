<?php
declare(strict_types=1);

namespace WPTG\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT | Attribute::IS_REPEATABLE)]
class ThemeFile
{
    public function __construct(
        public string $path,
        public bool   $required = true
    )
    {
    }
}