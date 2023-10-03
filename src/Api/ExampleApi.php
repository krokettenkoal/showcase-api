<?php

namespace OpenAPIServer\Api;

use OpenAPIServer\Api\AbstractExampleApi;
use OpenAPIServer\Util\ApiUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExampleApi extends AbstractExampleApi
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getExampleById(ServerRequestInterface $request, ResponseInterface $response, int $exampleId): ResponseInterface
    {
        $statement = $this->pdo->prepare('SELECT Id as id, SessionId as sessionId, Title as title, Subtitle as subtitle, Image as image, Icon as icon, Component as component FROM `examples` WHERE Id = :exampleId');
        $statement->execute(['exampleId' => $exampleId]);
        return ApiUtil::fetch($statement, $response);
    }

    public function getExamplesBySession(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        $sessionId = intval($params['sessionId']);
        $statement = $this->pdo->prepare('SELECT Id as id, SessionId as sessionId, Title as title, Subtitle as subtitle, Image as image, Icon as icon, Component as component FROM `examples` WHERE SessionId = :sessionId');
        $statement->execute(['sessionId' => $sessionId]);
        $examples = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return ApiUtil::json($examples, $response);
    }
}