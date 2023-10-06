<?php

namespace Phpress\Model;

require_once __DIR__ . '/ApiModel.php';

/**
 * A course (LV) in a study program
 */
class Course extends ApiModel
{
    public int $id;
    public int $studyProgramId;
    public string $title;
    public ?string $subtitle;
    public ?string $moodleUrl;
}
