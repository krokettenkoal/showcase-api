<?php

namespace OpenAPIServer\Api;

use OpenAPIServer\Api\AbstractSourceApi;
use OpenAPIServer\Util\ApiUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SourceApi extends AbstractSourceApi
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSourceById(ServerRequestInterface $request, ResponseInterface $response, int $sourceId): ResponseInterface
    {
        $statement = $this->pdo->prepare('SELECT Id as id, ExampleId as exampleId, SourceTypeId as typeId, Title as title, Code as code FROM `sources` WHERE Id = :sourceId');
        $statement->execute(['sourceId' => $sourceId]);
        $source = $statement->fetch(\PDO::FETCH_ASSOC);
        return ApiUtil::json($source, $response);
    }

    public function getSourcesByExample(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        $exampleId = intval($params['exampleId']);
        $statement = $this->pdo->prepare('SELECT Id as id, ExampleId as exampleId, SourceTypeId as typeId, Title as title, Code as code, Priority as priority FROM `sources` WHERE ExampleId = :exampleId');
        $statement->execute(['exampleId' => $exampleId]);
        $sources = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return ApiUtil::json($sources, $response);
    }
}