<?php

namespace Phpress\Model;

require_once __DIR__ . '/ApiModel.php';

/**
 * A code example as demonstrated in a session
 */
class Example extends ApiModel
{
    public int $id;
    public int $sessionId;
    public string $title;
    public ?string $subtitle;
    public ?string $icon;
    public ?string $image;
    public ?string $component;
}
