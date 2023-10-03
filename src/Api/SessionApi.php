<?php

namespace OpenAPIServer\Api;

use OpenAPIServer\Api\AbstractSessionApi;
use OpenAPIServer\Util\ApiUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SessionApi extends AbstractSessionApi
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSessionById(ServerRequestInterface $request, ResponseInterface $response, int $sessionId): ResponseInterface
    {
        $statement = $this->pdo->prepare('SELECT Id as id, CourseId as courseId, Title as title, Subtitle as subtitle, Image as image, Date as date FROM `sessions` WHERE Id = :sessionId');
        $statement->execute(['sessionId' => $sessionId]);
        return ApiUtil::fetch($statement, $response);
    }

    public function getSessionsByCourse(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        $courseId = intval($params['courseId']);
        $statement = $this->pdo->prepare('SELECT Id as id, CourseId as courseId, Title as title, Subtitle as subtitle, Image as image, Date as date FROM `sessions` WHERE CourseId = :courseId');
        $statement->execute(['courseId' => $courseId]);
        $sessions = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return ApiUtil::json($sessions, $response);
    }
}
