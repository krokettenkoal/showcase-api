<?php

namespace OpenAPIServer\Api;

use OpenAPIServer\Api\AbstractSourcetypeApi;
use OpenAPIServer\Util\ApiUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SourcetypeApi extends AbstractSourcetypeApi
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSourceTypes(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $statement = $this->pdo->query('SELECT Id as id, Title as title, Icon as icon, Language as language FROM `sourcetypes`');
        $sourceTypes = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return ApiUtil::json($sourceTypes, $response);
    }

    public function getSourceTypeById(ServerRequestInterface $request, ResponseInterface $response, int $typeId): ResponseInterface
    {
        $statement = $this->pdo->prepare('SELECT Id as id, Title as title, Icon as icon, Language as language FROM `sourcetypes` WHERE Id = :typeId');
        $statement->execute(['typeId' => $typeId]);
        return ApiUtil::fetch($statement, $response);
    }
}