<?php

namespace Phpress\Handler;

require_once __DIR__ . '/ApiHandler.php';
require_once __DIR__ . '/../Model/StudyProgram.php';
require_once __DIR__ . '/../Exception/ApiException.php';

use Phpress\Model\StudyProgram;
use Phpress\Exception\ApiException;

class StudyProgramHandler extends ApiHandler
{
    /**
     * Get all study programs
     * @return StudyProgram[] all study programs
     */
    public function getStudyPrograms(): array
    {
        $statement = $this->db->query('SELECT Id as id, Title as title, Subtitle as subtitle FROM `studyprograms`');
        $programs = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($program): StudyProgram => new StudyProgram($program), $programs);
    }

    /**
     * Get a study program by id
     * @param int $programId id of study program to get
     * @return StudyProgram The study program with the given id
     * @throws ApiException if the study program with the given id does not exist
     */
    public function getStudyProgramById(int $programId): StudyProgram
    {
        $statement = $this->db->prepare('SELECT Id as id, Title as title, Subtitle as subtitle FROM `studyprograms` WHERE Id = :programId');
        $statement->execute(['programId' => $programId]);
        $program = $statement->fetch(\PDO::FETCH_ASSOC);

        if(empty($program))
            throw new ApiException(404, "Study program with id $programId not found");

        return new StudyProgram($program);
    }
}
