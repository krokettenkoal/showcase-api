<?php

namespace Phpress\Router;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../Util/StringUtil.php';
require_once __DIR__ . '/../Util/Logger.php';

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Util\StringUtil;
use Phpress\Util\Logger;

const HTTP_GET = 'GET';
const HTTP_POST = 'POST';
const HTTP_PUT = 'PUT';
const HTTP_DELETE = 'DELETE';
const HTTP_PATCH = 'PATCH';
const HTTP_OPTIONS = 'OPTIONS';
const HTTP_HEAD = 'HEAD';
const HTTP_TRACE = 'TRACE';
const HTTP_CONNECT = 'CONNECT';

class Router {
    /**
     * @var string The base path of the router, being stripped from the request path
     */
    private string $base;

    /**
     * All registered routes
     * @var array The routes, grouped by HTTP method
     */
    private array $routes;

    /**
     * All registered middleware
     * @var array The middleware to run before each route
     */
    private array $middleware;

    /**
     * @var Logger The logger to use
     */
    private Logger $logger;

    /**
     * Creates a new Router
     * @param string|null $logName The name of the logger to use (optional)
     */
    public function __construct(?string $base = null, ?string $logName = null) {
        $this->base = rtrim($base ?? '', '/');
        $this->middleware = [];
        $this->routes = [];
        $this->logger = new Logger($logName);
        $this->middleware($this->stripBase(...));
    }

    /**
     * Gets the base path of the router
     * @return string The base path of the router, being stripped from the request path
     */
    public function getBase(): string {
        return $this->base;
    }

    /**
     * Gets the name of the router's logger
     * @return string|null The name of the router's logger
     */
    public function getLogName(): ?string {
        return $this->logger->getName();
    }

    /**
     * Validate an HTTP method
     * @param string $method The HTTP method to validate
     * @return string The validated HTTP method (uppercase)
     * @throws InvalidArgumentException If the method is invalid
     */
    private static function validateHttpMethod(string $method): string {
        $method = strtoupper($method);
        return match ($method) {
            HTTP_GET, HTTP_POST, HTTP_PUT, HTTP_DELETE, HTTP_PATCH, HTTP_OPTIONS, HTTP_HEAD, HTTP_TRACE, HTTP_CONNECT => $method,
            default => throw new InvalidArgumentException("Invalid HTTP method $method"),
        };
    }

    /**
     * Validate a route pattern
     * @param string $route The route pattern to validate
     * @return string The validated route pattern
     * @throws InvalidArgumentException If the route is invalid
     */
    private static function validateRoute(string $route): string {
        if(StringUtil::isNullOrEmpty($route))
            throw new InvalidArgumentException("Invalid route: must have at least a leading slash");

        $rx = '/^\/(\{?\w+}?\/?)*$/';
        if(!preg_match($rx, $route))
            throw new InvalidArgumentException("Invalid route $route: must start with a slash and contain only alphanumeric characters, slashes and curly braces (path params)");

        return $route;
    }

    /**
     * Strips the base path from a path
     * @param string $path The path to strip the base from
     * @param string $base The base path to strip from the path
     * @return string The path without the base
     */
    private static function stripBasePath(string $path, string $base = '/'): string {
        $rx = '/^' . str_replace('/', '\/', $base) . '/';
        return preg_replace($rx, '', rtrim($path, '/') . '/');
    }

    private function stripBase(Request &$req, Response $res): void {
        $req->server->set('REQUEST_URI', self::stripBasePath($req->server->get('REQUEST_URI'), $this->base));
    }

    /**
     * Sets the status code and optional error content on a Response, without sending it.
     * Also writes the error to the log.
     * @param Request $req The request the error response is associated with
     * @param Response $res The response to set the status code and content on
     * @param int $code The HTTP response code. Defaults to 500 (actually 0, but that's mapped to 500)
     * @param string $message The error message to send as JSON (optional)
     */
    private function error(Request $req, Response $res, int $code = 0, string $message = ''): void {
        $code = $code === 0 ? 500 : $code;
        $res->setStatusCode($code);
        $lvl = $code === 404 ? Logger::LOG_LEVEL_INFO : Logger::LOG_LEVEL_ERROR;
        $log = "Error $code on " . $req->getMethod() . ' ' . $req->server->get('REQUEST_URI');

        if(!StringUtil::isNullOrEmpty($message)) {
            $res->setContent(json_encode(['error' => $message]));
            $log .= ": $message";
        }

        $this->logger->log($lvl, $log);
    }

    /**
     * Sends an error response
     * @param Request $req The request the error response is associated with
     * @param Response $res The response to send the error response on
     * @param int $code The HTTP response code. Defaults to 500 (actually 0, but that's mapped to 500)
     * @param string $message The error message to send as JSON (optional)
     */
    private function sendError(Request $req, Response $res, int $code = 0, string $message = ''): void {
        $this->error($req, $res, $code, $message);
        $res->prepare($req);
        $res->send();
    }

    /**
     * Matches a request to a route
     * @param Request $req The request to match
     * @param array|null $route The matched route (if any), including the callback
     * @return bool Whether a route was matched
     */
    private function matchRoute(Request $req, ?array &$route): bool {
        $path = rtrim(strtok($req->server->get('REQUEST_URI'), '?'), '/');
        $method = strtoupper($req->getMethod());
        $route = null;
        foreach($this->routes[$method] as $r) {
            $rt = rtrim($r['path'], '/');
            $rx = '/^' . str_replace('/', '\/', preg_replace('/\{(\w+)}/', '(?<$1>\w+)', $rt)) . '$/';
            if(preg_match_all($rx, $path, $matches)){
                $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
                foreach($matches as $param => $match){
                    foreach($match as $val){
                        $req->attributes->set($param, $val);
                    }
                }
                $route = $r;
                return true;
            }
        }
        return false;
    }

    /**
     * Interpolates a path with the given request, replacing path parameters with their values from the request query
     * @param string $path The path to interpolate
     * @param Request|null $req The request to interpolate the path with (optional). If not provided, the request is created from globals.
     * @return string The interpolated path
     * @example interpolateQuery('/example/{id}', new Request([], [], ['id' => 1])) returns '/example/1'
     */
    private function interpolateQuery(string $path, ?Request $req = null): string {
        $req ??= Request::createFromGlobals();
        $tokens = [];
        $path = rtrim($path, '/');
        $rx = '/\{(\w+)}/';
        preg_match_all($rx, $path, $tokens);
        $tokens = $tokens[1];
        foreach($tokens as $token) {
            $path = str_replace('{' . $token . '}', $req->query->get($token), $path);
        }

        return $path;
    }

    /**
     * Handles a request, usually called from a static php file to route API requests
     * @param Request|null $req The request to handle (optional). If not provided, the request is created from globals.
     * @param string|null $path The path to handle (optional). If not provided, the path is taken from the request.
     * @see Request::createFromGlobals()
     */
    public function handle(?Request $req = null, ?string $path = null): void {
        $req ??= Request::createFromGlobals();
        $res = new Response(
            null,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
        $res->setCharset('utf-8');

        //  Run middleware
        foreach ($this->middleware as $m) {
            try {
                $m($req, $res);
            }
            catch(\Exception $e) {
                $this->sendError($req, $res, $e->getCode(), $e->getMessage());
                return;
            }
        }

        //  Find matching route
        if(!$this->matchRoute($req, $route)) {
            $this->sendError($req, $res, 404);
            return;
        }

        try {
            //  Call the route handler
            $route['callback']($req, $res);
        }
        catch(\Exception $e) {
            $this->error($req, $res, $e->getCode(), $e->getMessage());
        }
        finally {
            $res->prepare($req);
            $res->send();
        }
    }

    /**
     * Registers a middleware to run before each route
     * @param callable $callback The middleware to run before each route
     * @return void
     */
    public function middleware(callable $callback): void {
        $this->middleware[] = $callback;
    }

    /**
     * Registers a route with a path pattern, method, and callback
     * @param string $path The path pattern to register
     * @param string $method The HTTP method to register the route for
     * @param callable $callback The callback to call when the route is matched
     * @throws InvalidArgumentException If the path or method is invalid
     */
    public function route(string $path, string $method, callable $callback): void {
        try {
            //  Validate path and method
            $method = self::validateHttpMethod($method);
            $path = self::validateRoute($path);
        } catch (InvalidArgumentException $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }

        // Initialize the routes array for the method if it doesn't exist
        if(!array_key_exists($method, $this->routes)) {
            $this->routes[$method] = [];
        }

        $this->routes[$method][] = [
            'path' => $path,
            'callback' => $callback
        ];
    }

    /**
     * Registers a new GET route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function get(string $path, callable $callback): void {
        $this->route($path, HTTP_GET, $callback);
    }

    /**
     * Registers a new POST route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function post(string $path, callable $callback): void {
        $this->route($path, HTTP_POST, $callback);
    }

    /**
     * Registers a new PUT route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function put(string $path, callable $callback): void {
        $this->route($path, HTTP_PUT, $callback);
    }

    /**
     * Registers a new DELETE route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function delete(string $path, callable $callback): void {
        $this->route($path, HTTP_DELETE, $callback);
    }

    /**
     * Registers a new PATCH route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function patch(string $path, callable $callback): void {
        $this->route($path, HTTP_PATCH, $callback);
    }

    /**
     * Registers a new OPTIONS route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function options(string $path, callable $callback): void {
        $this->route($path, HTTP_OPTIONS, $callback);
    }

    /**
     * Registers a new HEAD route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function head(string $path, callable $callback): void {
        $this->route($path, HTTP_HEAD, $callback);
    }

    /**
     * Registers a new TRACE route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function trace(string $path, callable $callback): void {
        $this->route($path, HTTP_TRACE, $callback);
    }

    /**
     * Registers a new CONNECT route
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function connect(string $path, callable $callback): void {
        $this->route($path, HTTP_CONNECT, $callback);
    }

    /**
     * Registers a new route for all HTTP methods
     * @param string $path The path pattern to register
     * @param callable $callback The callback to call when the route is matched
     * @return void
     */
    public function all(string $path, callable $callback): void {
        $this->route($path, HTTP_GET, $callback);
        $this->route($path, HTTP_POST, $callback);
        $this->route($path, HTTP_PUT, $callback);
        $this->route($path, HTTP_DELETE, $callback);
        $this->route($path, HTTP_PATCH, $callback);
        $this->route($path, HTTP_OPTIONS, $callback);
        $this->route($path, HTTP_HEAD, $callback);
        $this->route($path, HTTP_TRACE, $callback);
        $this->route($path, HTTP_CONNECT, $callback);
    }
}