<?php

namespace OpenAPIServer\Api;

use OpenAPIServer\Api\AbstractCourseApi;
use OpenAPIServer\Util\ApiUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CourseApi extends AbstractCourseApi
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCourses(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $statement = $this->pdo->query('SELECT Id as id, Title as title, Subtitle as subtitle FROM `courses`');
        $courses = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return ApiUtil::json($courses, $response);
    }

    public function getCourseById(ServerRequestInterface $request, ResponseInterface $response, int $courseId): ResponseInterface
    {
        $statement = $this->pdo->prepare('SELECT Id as id, Title as title, Subtitle as subtitle FROM `courses` WHERE Id = :courseId');
        $statement->execute(['courseId' => $courseId]);
        return ApiUtil::fetch($statement, $response);
    }
}
