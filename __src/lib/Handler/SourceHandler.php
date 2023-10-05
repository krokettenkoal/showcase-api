<?php

namespace Phpress\Handler;

require_once __DIR__ . '/ApiHandler.php';
require_once __DIR__ . '/../Model/Source.php';
require_once __DIR__ . '/../Exception/ApiException.php';

use Phpress\Model\Source;
use Phpress\Exception\ApiException;

class SourceHandler extends ApiHandler
{
    /**
     * Get the source code with the given id
     * @param int $sourceId id of source code to get
     * @return Source source code with the given id
     * @throws ApiException if the source code with the given id does not exist
     */
    public function getSourceById(int $sourceId): Source
    {
        $statement = $this->db->prepare('SELECT Id as id, ExampleId as exampleId, SourceTypeId as typeId, Title as title, Code as code FROM `sources` WHERE Id = :sourceId');
        $statement->execute(['sourceId' => $sourceId]);
        $source = $statement->fetch(\PDO::FETCH_ASSOC);

        if(empty($source))
            throw new ApiException(404, "Source with id $sourceId not found");

        return new Source($source);
    }

    /**
     * Get all source codes for the given example
     * @param int $exampleId id of example to get source codes for
     * @return Source[] array of source codes for the given example
     */
    public function getSourcesByExample(int $exampleId): array
    {
        $statement = $this->db->prepare('SELECT Id as id, ExampleId as exampleId, SourceTypeId as typeId, Title as title, Code as code, Priority as priority FROM `sources` WHERE ExampleId = :exampleId');
        $statement->execute(['exampleId' => $exampleId]);
        $sources = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($source): Source => new Source($source), $sources);
    }
}