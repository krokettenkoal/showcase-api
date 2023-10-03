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
 * AbstractCourseApi Class Doc Comment
 *
 * @package OpenAPIServer\Api
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 */
abstract class AbstractCourseApi
{
    /**
     * GET getCourseById
     * Summary: Course by id
     * Notes: Retrieve a course by its id.
     * Output-Formats: [application/json]
     *
     * @param ServerRequestInterface $request  Request
     * @param ResponseInterface      $response Response
     * @param int $courseId courseId
     *
     * @return ResponseInterface
     * @throws HttpNotImplementedException to force implementation class to override this method
     */
    public function getCourseById(
        ServerRequestInterface $request,
        ResponseInterface $response,
        int $courseId
    ): ResponseInterface {
        $message = "How about implementing getCourseById as a GET method in OpenAPIServer\Api\CourseApi class?";
        throw new HttpNotImplementedException($request, $message);
    }

    /**
     * GET getCourses
     * Summary: All courses
     * Notes: Retrieve all courses.
     * Output-Formats: [application/json]
     *
     * @param ServerRequestInterface $request  Request
     * @param ResponseInterface      $response Response
     *
     * @return ResponseInterface
     * @throws HttpNotImplementedException to force implementation class to override this method
     */
    public function getCourses(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $message = "How about implementing getCourses as a GET method in OpenAPIServer\Api\CourseApi class?";
        throw new HttpNotImplementedException($request, $message);
    }
}
