<?php

namespace Phpress\Controller;

/**
 * Base class for router controllers, serving as connection between the router and the handler
 */
abstract class BaseController
{
    /**
     * Lazy-initializes the controller
     * @return void
     */
    protected static abstract function lazyInit(): void;
}