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
 */
namespace OpenAPIServer\Model;

use OpenAPIServer\BaseModel;

/**
 * Source
 *
 * @package OpenAPIServer\Model
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 */
class Source extends BaseModel
{
    /**
     * @var string Models namespace.
     * Can be required for data deserialization when model contains referenced schemas.
     */
    protected const MODELS_NAMESPACE = '\OpenAPIServer\Model';

    /**
     * @var string Constant with OAS schema of current class.
     * Should be overwritten by inherited class.
     */
    protected const MODEL_SCHEMA = <<<'SCHEMA'
{
  "title" : "Source",
  "required" : [ "code", "exampleId", "id", "priority", "typeId" ],
  "type" : "object",
  "properties" : {
    "id" : {
      "type" : "integer",
      "description" : "The (internal) id of the source"
    },
    "exampleId" : {
      "type" : "integer",
      "description" : "The id of the example the source belongs to"
    },
    "typeId" : {
      "type" : "integer",
      "description" : "The type (language/framework) id of the source"
    },
    "title" : {
      "type" : "string",
      "description" : "The title of the source code, e.g. 'index.html', 'main.js', to show instead of the source type name (optional)"
    },
    "code" : {
      "type" : "string",
      "description" : "The source code"
    },
    "priority" : {
      "type" : "integer",
      "description" : "The priority of the source code, affecting the order of the sources in the UI. The higher the priority, the farther the source code tab is to the left. Defaults to 0.",
      "default" : 0
    }
  },
  "description" : "A source code of an example"
}
SCHEMA;
}
