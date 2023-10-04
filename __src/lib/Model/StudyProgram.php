<?php

require_once __DIR__ . '/ApiModel.php';

/**
 * A study program at St. Pölten UAS
 */
class StudyProgram extends ApiModel
{
    public int $id;
    public string $title;
    public string $subtitle;
}
