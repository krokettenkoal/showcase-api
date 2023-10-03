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

declare(strict_types=1);

/**
 * NOTE: This class is auto generated by the openapi generator program.
 * https://github.com/openapitools/openapi-generator
 * Do not edit the class manually.
 */
namespace OpenAPIServer\App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotImplementedException;

/**
 * RegisterRoutes Class Doc Comment
 *
 * @package OpenAPIServer
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 */
class RegisterRoutes
{
    /** @var array[] list of all api operations */
    private $operations = [
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/course',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractCourseApi',
            'userClassname' => 'CourseApi',
            'operationId' => 'getCourses',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "type" : "array",
        "items" : {
          "$ref" : "#/components/schemas/Course"
        }
      }
    }
  }
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/course/{courseId}',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractCourseApi',
            'userClassname' => 'CourseApi',
            'operationId' => 'getCourseById',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "$ref" : "#/components/schemas/Course"
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/example',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractExampleApi',
            'userClassname' => 'ExampleApi',
            'operationId' => 'getExamplesBySession',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "type" : "array",
        "items" : {
          "$ref" : "#/components/schemas/Example"
        }
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/example/{exampleId}',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractExampleApi',
            'userClassname' => 'ExampleApi',
            'operationId' => 'getExampleById',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "$ref" : "#/components/schemas/Example"
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/session',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractSessionApi',
            'userClassname' => 'SessionApi',
            'operationId' => 'getSessionsByCourse',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "type" : "array",
        "items" : {
          "$ref" : "#/components/schemas/Session"
        }
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/session/{sessionId}',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractSessionApi',
            'userClassname' => 'SessionApi',
            'operationId' => 'getSessionById',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "$ref" : "#/components/schemas/Session"
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/source',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractSourceApi',
            'userClassname' => 'SourceApi',
            'operationId' => 'getSourcesByExample',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "type" : "array",
        "items" : {
          "$ref" : "#/components/schemas/Source"
        }
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/source/{sourceId}',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractSourceApi',
            'userClassname' => 'SourceApi',
            'operationId' => 'getSourceById',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "$ref" : "#/components/schemas/Source"
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/sourcetype',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractSourcetypeApi',
            'userClassname' => 'SourcetypeApi',
            'operationId' => 'getSourceTypes',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "type" : "array",
        "items" : {
          "$ref" : "#/components/schemas/SourceType"
        }
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/sourcetype/{typeId}',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractSourcetypeApi',
            'userClassname' => 'SourcetypeApi',
            'operationId' => 'getSourceTypeById',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "$ref" : "#/components/schemas/SourceType"
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/studyprogram',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractStudyprogramApi',
            'userClassname' => 'StudyprogramApi',
            'operationId' => 'getStudyPrograms',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "type" : "array",
        "items" : {
          "$ref" : "#/components/schemas/StudyProgram"
        }
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
        [
            'httpMethod' => 'GET',
            'basePathWithoutHost' => '/api',
            'path' => '/studyprogram/{programId}',
            'apiPackage' => 'OpenAPIServer\Api',
            'classname' => 'AbstractStudyprogramApi',
            'userClassname' => 'StudyprogramApi',
            'operationId' => 'getStudyProgramById',
            'responses' => [
                '200' => [
                    'jsonSchema' => '{
  "description" : "OK",
  "content" : {
    "application/json" : {
      "schema" : {
        "$ref" : "#/components/schemas/StudyProgram"
      }
    }
  }
}',
                ],
                '404' => [
                    'jsonSchema' => '{
  "description" : "Not Found"
}',
                ],
            ],
            'authMethods' => [
            ],
        ],
    ];

    /**
     * Add routes to Slim app.
     *
     * @param \Slim\App $app Pre-configured Slim application instance
     *
     * @throws HttpNotImplementedException When implementation class doesn't exists
     */
    public function __invoke(\Slim\App $app): void
    {
        $app->options('/{routes:.*}', function (ServerRequestInterface $request, ResponseInterface $response) {
            // CORS Pre-Flight OPTIONS Request Handler
            return $response;
        });

        // create mock middleware factory
        /** @var \Psr\Container\ContainerInterface */
        $container = $app->getContainer();
        /** @var \OpenAPIServer\Mock\OpenApiDataMockerRouteMiddlewareFactory|null */
        $mockMiddlewareFactory = null;
        if ($container->has(\OpenAPIServer\Mock\OpenApiDataMockerRouteMiddlewareFactory::class)) {
            // I know, anti-pattern. Don't retrieve dependency directly from container
            $mockMiddlewareFactory = $container->get(\OpenAPIServer\Mock\OpenApiDataMockerRouteMiddlewareFactory::class);
        }

        foreach ($this->operations as $operation) {
            $callback = function (ServerRequestInterface $request) use ($operation) {
                $message = "How about extending {$operation['classname']} by {$operation['apiPackage']}\\{$operation['userClassname']} class implementing {$operation['operationId']} as a {$operation['httpMethod']} method?";
                throw new HttpNotImplementedException($request, $message);
            };
            $middlewares = [];

            if (class_exists("\\{$operation['apiPackage']}\\{$operation['userClassname']}")) {
                // Notice how we register the controller using the class name?
                // PHP-DI will instantiate the class for us only when it's actually necessary
                $callback = ["\\{$operation['apiPackage']}\\{$operation['userClassname']}", $operation['operationId']];
            }

            if ($mockMiddlewareFactory) {
                $mockSchemaResponses = array_map(function ($item) {
                    return json_decode($item['jsonSchema'], true);
                }, $operation['responses']);
                $middlewares[] = $mockMiddlewareFactory->create($mockSchemaResponses);
            }

            $route = $app->map(
                [$operation['httpMethod']],
                "{$operation['basePathWithoutHost']}{$operation['path']}",
                $callback
            )->setName($operation['operationId']);

            foreach ($middlewares as $middleware) {
                $route->add($middleware);
            }
        }
    }
}
