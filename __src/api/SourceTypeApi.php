<?php

require_once __DIR__ . '/BaseApi.php';
require_once __DIR__ . '/../lib/Model/SourceType.php';
require_once __DIR__ . '/../lib/ApiException.php';

class SourceTypeApi extends BaseApi
{
    /**
     * Get all source types
     * @return SourceType[] all source types
     */
    public function getSourceTypes(): array
    {
        $statement = $this->db->query('SELECT Id as id, Title as title, Icon as icon, Language as language FROM `sourcetypes`');
        $sourceTypes = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($sourceType): SourceType => new SourceType($sourceType), $sourceTypes);
    }

    /**
     * Get source type by id
     * @param int $typeId id of source type to get
     * @return SourceType source type with the given id
     * @throws ApiException if the source type with the given id does not exist
     */
    public function getSourceTypeById(int $typeId): SourceType
    {
        $statement = $this->db->prepare('SELECT Id as id, Title as title, Icon as icon, Language as language FROM `sourcetypes` WHERE Id = :typeId');
        $statement->execute(['typeId' => $typeId]);
        $sourceType = $statement->fetch(PDO::FETCH_ASSOC);

        if(empty($sourceType))
            throw new ApiException(404, "Source type with id $typeId not found");

        return new SourceType($sourceType);
    }
}