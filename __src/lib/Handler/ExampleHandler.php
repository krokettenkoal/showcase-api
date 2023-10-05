<?php

namespace Phpress\Handler;

require_once __DIR__ . '/ApiHandler.php';
require_once __DIR__ . '/../Model/Example.php';
require_once __DIR__ . '/../Exception/ApiException.php';

use Phpress\Model\Example;
use Phpress\Exception\ApiException;

class ExampleHandler extends ApiHandler
{

    /**
     * Get the example with the given id
     * @param int $exampleId id of example to get
     * @return Example the example with the given id
     * @throws ApiException if the example with the given id does not exist
     */
    public function getExampleById(int $exampleId): Example
    {
        $statement = $this->db->prepare('SELECT Id as id, SessionId as sessionId, Title as title, Subtitle as subtitle, Image as image, Icon as icon, Component as component FROM `examples` WHERE Id = :exampleId');
        $statement->execute(['exampleId' => $exampleId]);
        $example = $statement->fetch(\PDO::FETCH_ASSOC);

        if(empty($example))
            throw new ApiException(404, "Example with id $exampleId not found");

        return new Example($example);
    }

    /**
     * Get all examples for the given session
     * @param int $sessionId id of session to get examples for
     * @return Example[] all examples for the given session
     */
    public function getExamplesBySession(int $sessionId): array
    {
        $statement = $this->db->prepare('SELECT Id as id, SessionId as sessionId, Title as title, Subtitle as subtitle, Image as image, Icon as icon, Component as component FROM `examples` WHERE SessionId = :sessionId');
        $statement->execute(['sessionId' => $sessionId]);
        $examples = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($example): Example => new Example($example), $examples);
    }
}