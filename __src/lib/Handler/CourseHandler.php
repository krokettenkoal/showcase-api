<?php

namespace Phpress\Handler;

require_once __DIR__ . '/ApiHandler.php';
require_once __DIR__ . '/../Model/Course.php';
require_once __DIR__ . '/../Exception/ApiException.php';

use Phpress\Model\Course;
use Phpress\Exception\ApiException;

class CourseHandler extends ApiHandler
{
    /**
     * Get all courses
     * @return Course[] all courses
     */
    public function getCourses(): array
    {
        $statement = $this->db->query('SELECT Id as id, StudyProgramId as studyProgramId, Title as title, Subtitle as subtitle, MoodleUrl as moodleUrl FROM `courses`');
        $courses = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($course): Course => new Course($course), $courses);
    }

    /**
     * Get course by id
     * @param int $courseId id of course to get
     * @return Course course with the given id
     * @throws ApiException if the course with the given id does not exist
     */
    public function getCourseById(int $courseId): Course
    {
        $statement = $this->db->prepare('SELECT Id as id, StudyProgramId as studyProgramId, Title as title, Subtitle as subtitle, MoodleUrl as moodleUrl FROM `courses` WHERE Id = :courseId');
        $statement->execute(['courseId' => $courseId]);
        $course = $statement->fetch(\PDO::FETCH_ASSOC);

        if(empty($course))
            throw new ApiException(404, "Course with id $courseId not found");

        return new Course($course);
    }
}
