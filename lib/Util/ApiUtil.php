<?php

namespace OpenAPIServer\Util;

use Psr\Http\Message\ResponseInterface;

class ApiUtil
{
    public static function json($payload, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write(json_encode($payload));
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public static function fetch(\PDOStatement $statement, ResponseInterface $response, int $mode = \PDO::FETCH_ASSOC): ResponseInterface
    {
        $statement->execute();
        $data = $statement->fetchAll($mode);
        if ($data) {
            return ApiUtil::json($data, $response);
        } else {
            return $response->withStatus(404);
        }
    }
}
