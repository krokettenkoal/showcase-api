<?php

namespace Phpress\Model;

require_once __DIR__ . '/ApiModel.php';

/**
 * A type (language/framework) of a source code
 */
class SourceType extends ApiModel
{
    public int $id;
    public string $title;
    public ?string $icon;
    public ?string $language;
}
