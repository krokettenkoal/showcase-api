# Showcase API
> Static REST API for the UAS Showcase, built for scenarios where URL rewriting is not available.

## Requirements
* PHP 8.1 or newer
* (Static) web server
* SQL database (e.g. MySQL, MariaDB, PostgreSQL)
* Composer (installer included in package)

## Installation
Depending on your environment, there are different ways to install the API. Choose the one that fits your environment best.

### Manual installation (CLI/SSH)
This is the **recommended** installation method for environments with **CLI/SSH access**. 
If you don't terminal access, see the [Installer](#installer-php) section.
1. **Clone** the repository using ```git clone https://github.com/krokettenkoal/showcase-api.git```
2. **Download & install** [Composer](https://getcomposer.org/download/) (if not yet installed)
3. **Install dependencies** by switching into the project's root directory and executing ```composer install```
4. **Import database tables** using the provided [SQL dump](/__setup/import-db.sql) (e.g. using phpMyAdmin)

### Installer (PHP)
Choose this installation method if you **don't have terminal access** to your server (e.g. for [CampusCloud](https://fhstp.cc)/[SHEEP](https://management.students.fhstp.ac.at)).
1. **Clone** the repository to your local machine using ```git clone https://github.com/krokettenkoal/showcase-api.git```
2. **Copy** the cloned repository to your server (e.g. using SFTP). *If you copy the project into a subdirectory, make sure to set the API's `router.base` property in the [Configuration](#configuration) file accordingly.*
3. Open the `setup.php` page in your browser (e.g. `https://example.com/api/setup.php`) and follow the instructions.
4. **Import database tables** using the provided [SQL dump](/__setup/import-db.sql) (e.g. using phpMyAdmin)

## Configuration
The `__src/config` directory contains an [example config file](/__src/config/example.inc.php) that may be used as a template. To create a configuration for a certain environment (`prod` or `dev`), copy the example config and name it `<mode>.inc.php`.
For example, name the new config file `dev.inc.php` and tweak the config values to your development environment.
> To use the `dev` configuration (or other environments other than `prod`), you must set the environment variable `API_MODE` to the desired value. For example, this can be done when starting the built-in PHP server or by using Apache's [mod_env](https://httpd.apache.org/docs/2.4/mod/mod_env.html) module.
> If no environment is specified, the `prod` environment will be used.

### Configuration objects
Each configuration file contains a number of configuration objects. These objects are used to configure different parts of the API. The following configuration objects are available:
#### Database config (CFG_DB)
| Key            | Type     | Description                               |
|----------------|----------|-------------------------------------------|
| *pdo.dsn*      | `string` | The DSN to connect to the database with.  |
| *pdo.username* | `string` | The user to connect to the database with. |
| *pdo.password* | `string` | The password for the database user.       |
| *pdo.options*  | `array`  | Additional PDO options                    |

See also: [PDO::__construct](https://www.php.net/manual/en/pdo.construct.php)

#### API config (CFG_API)
| Key           | Type     | Description                                                                                        |
|---------------|----------|----------------------------------------------------------------------------------------------------|
| *router.base* | `string` | The base path of the API (where the project resides in). Stripped from request URLs by the router. |

## Run development server
To start a local development server, either use the built-in PHP server or a web server of your choice. The built-in PHP server can be started by executing the following command in the project's root directory:
```bash
php -S localhost:8888
```
> Remember to set the environment variable `API_MODE` to `dev`, as described in the [Configuration](#configuration) section.

## Routing
Since this API is built for scenarios where URL rewriting is not supported, every API route must have their own `index.php` file under the corresponding path, calling the `Router` class to handle the request.

### Create static route
To create a new static route, create a new folder hierarchy directly inside the project root, resembling the API route (each portion of the path being a subdirectory). Inside each directory resembling an API route, create an `index.php` file, require a `Router` from the `__routers` directory and call its `Router::handle()` method. The method takes two optional parameters: 
* `$req`: The [Request](https://symfony.com/doc/current/components/http_foundation.html#request) object to handle. If not specified, the `Request` object will be created from the current request.
* `$path`: The request path to handle. If not specified, the current request path will be used. By supplying a custom path, you can handle requests for a different path than the current one (pseudo-rewriting).

### Register route
To register the static routes you have created, create a new file inside the `__routers` directory and instantiate a new `Router` object (or use an existing one). To register a route, call the `Router::route()` method on the `Router` object. The method takes three parameters:
* `$path`: The path to route. Supports path parameters in the form of `{param}`. Must start with a leading `/`.
* `$method`: The HTTP method to route. Must be one of the constants defined in the `Router` class.
* `$callback`: The handler to call when the route is requested. Must be a callable.

> The `Router` class also provides shorthand functions for each HTTP method, e.g. `Router::get()`. These functions are equivalent to calling the `route()` method with the corresponding HTTP method.