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
 * API for FHSTP Showcase
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

/**
 * RegisterMiddlewares
 *
 * Recommendations from template creator:
 *
 * There is no way to add route related middlewares here, add global ones. Route related middlewares
 * can be applied in \OpenAPIServer\App\RegisterRoutes class.
 *
 * I add middlewares by full class names(\Slim\Middleware\ErrorMiddleware::class) because that way
 * Slim initiates them with options from Container. They already configured, don't need to pass any
 * options manually.
 *
 * I don't use imports(eg. use Slim\Middleware\ErrorMiddleware) here because each package unlikely
 * be used in code twice. It helps to keep that file short and make Git history cleaner.
 *
 * This class declared as final because two classes with middlewares can cause confusion. Edit
 * template of this class or use your own implementation instead(overwrite index.php to import your
 * custom class).
 */
final class RegisterMiddlewares
{
    /**
     * Adds middlewares to Slim app instance.
     *
     * @param \Slim\App $app App instance.
     */
    public function __invoke(\Slim\App $app): void
    {
        // Parse json, form data and xml
        $app->addBodyParsingMiddleware();

        // Add Routing Middleware
        $app->addRoutingMiddleware();

        // Add Error Middleware
        $app->add(\Slim\Middleware\ErrorMiddleware::class);
    }
}
