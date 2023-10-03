<?php

namespace OpenAPIServer\Api;

use OpenAPIServer\Util\ApiUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StudyprogramApi extends AbstractStudyprogramApi
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getStudyPrograms(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $statement = $this->pdo->query('SELECT Id as id, Title as title, Subtitle as subtitle FROM `studyprograms`');
        $programs = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return ApiUtil::json($programs, $response);
    }

    public function getStudyProgramById(ServerRequestInterface $request, ResponseInterface $response, int $programId): ResponseInterface
    {
        $statement = $this->pdo->prepare('SELECT Id as id, Title as title, Subtitle as subtitle FROM `studyprograms` WHERE Id = :programId');
        $statement->execute(['programId' => $programId]);
        return ApiUtil::fetch($statement, $response);
    }
}
