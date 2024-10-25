<?php

namespace Casdorio\AnnotationRouter\Hooks;

use Casdorio\AnnotationRouter\Annotations\Controller;

class RouteRegistrar
{
    private $annotationProcessor;

    public function __construct()
    {
        $this->annotationProcessor = new AnnotationProcessor();
    }

    public function registerRoutes(Controller $controller, \ReflectionClass $reflectionClass)
    {
        if (!empty($controller->path)) {
            (new RouteGroupRegistrar())->registerRouteGroup($controller->path, $controller->options, $reflectionClass);
        } else {
            $this->registerRoute($reflectionClass);
        }
    }

    private function registerRoute(\ReflectionClass $controllerClass)
    {
        $routes = service('routes');

        foreach ($controllerClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $this->annotationProcessor->processApiEndpointAnnotations($method, $routes, $controllerClass);
        }

        $routes->loadRoutes();
    }

    public function registerApiEndpoints(\ReflectionMethod $method, $routes, \ReflectionClass $controllerClass)
    {
        $this->annotationProcessor->processApiEndpointAnnotations($method, $routes, $controllerClass);
    }
}