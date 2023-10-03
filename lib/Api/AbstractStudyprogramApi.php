<?php

/**
 * Showcase API
 * PHP version 7.4
 *
 * @package OpenAPIServer
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 */

/**
 * API for FHStP Showcase
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://github.com/openapitools/openapi-generator.git
 */

/**
 * NOTE: This class is auto generated by the openapi generator program.
 * https://github.com/openapitools/openapi-generator
 * Do not edit the class manually.
 * Extend this class with your controller. You can inject dependencies via class constructor,
 * @see https://github.com/PHP-DI/Slim-Bridge basic example.
 */
namespace OpenAPIServer\Api;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpNotImplementedException;

/**
 * AbstractStudyprogramApi Class Doc Comment
 *
 * @package OpenAPIServer\Api
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 */
abstract class AbstractStudyprogramApi
{
    /**
     * GET getStudyProgramById
     * Summary: Study program by id
     * Notes: Retrieve a study program by its id.
     * Output-Formats: [application/json]
     *
     * @param ServerRequestInterface $request  Request
     * @param ResponseInterface      $response Response
     * @param int $programId The id of the study program to retrieve
     *
     * @return ResponseInterface
     * @throws HttpNotImplementedException to force implementation class to override this method
     */
    public function getStudyProgramById(
        ServerRequestInterface $request,
        ResponseInterface $response,
        int $programId
    ): ResponseInterface {
        $message = "How about implementing getStudyProgramById as a GET method in OpenAPIServer\Api\StudyprogramApi class?";
        throw new HttpNotImplementedException($request, $message);
    }

    /**
     * GET getStudyPrograms
     * Summary: All study programs
     * Notes: Retrieve all study programs.
     * Output-Formats: [application/json]
     *
     * @param ServerRequestInterface $request  Request
     * @param ResponseInterface      $response Response
     *
     * @return ResponseInterface
     * @throws HttpNotImplementedException to force implementation class to override this method
     */
    public function getStudyPrograms(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $message = "How about implementing getStudyPrograms as a GET method in OpenAPIServer\Api\StudyprogramApi class?";
        throw new HttpNotImplementedException($request, $message);
    }
}
