<?php

namespace Phpress\Model;

require_once __DIR__ . '/ApiModel.php';

/**
 * A source code of an example
 */
class Source extends ApiModel
{
    public int $id;
    public int $exampleId;
    public int $typeId;
    public string $code;
    public int $priority = 0;
    public ?string $title;
}
