<?php

namespace Phpress\Handler;

require_once __DIR__ . '/ApiHandler.php';
require_once __DIR__ . '/../Model/Session.php';
require_once __DIR__ . '/../Exception/ApiException.php';

use Phpress\Model\Session;
use Phpress\Exception\ApiException;

class SessionHandler extends ApiHandler
{

    /**
     * Get the session with the given id
     * @param int $sessionId id of session to get
     * @return Session session with the given id
     * @throws ApiException if the session with the given id does not exist
     */
    public function getSessionById(int $sessionId): Session
    {
        $statement = $this->db->prepare('SELECT Id as id, CourseId as courseId, Title as title, Subtitle as subtitle, Image as image, Date as date FROM `sessions` WHERE Id = :sessionId');
        $statement->execute(['sessionId' => $sessionId]);
        $session = $statement->fetch(\PDO::FETCH_ASSOC);

        if(empty($session))
            throw new ApiException(404, "Session with id $sessionId not found");

        return new Session($session);
    }

    /**
     * Get all sessions for the given course
     * @param int $courseId id of course to get sessions for
     * @return Session[] sessions for the given course
     */
    public function getSessionsByCourse(int $courseId): array
    {
        $statement = $this->db->prepare('SELECT Id as id, CourseId as courseId, Title as title, Subtitle as subtitle, Image as image, Date as date FROM `sessions` WHERE CourseId = :courseId');
        $statement->execute(['courseId' => $courseId]);
        $sessions = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($session): Session => new Session($session), $sessions);
    }
}
