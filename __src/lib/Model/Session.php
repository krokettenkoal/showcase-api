<?php

require_once __DIR__ . '/ApiModel.php';

/**
 * A session (lecture or exercise) of a course
 */
class Session extends ApiModel
{
    public int $id;
    public int $courseId;
    public string $title;
    public ?string $subtitle;
    public ?string $image;
    public ?string $date;
}