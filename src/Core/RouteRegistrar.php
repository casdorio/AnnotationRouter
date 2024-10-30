<?php

namespace Casdorio\AnnotationRouter\Core;

use Casdorio\AnnotationRouter\Annotations\Controller;
use Casdorio\AnnotationRouter\Core\AnnotationProcessor;

class RouteRegistrar
{
    protected $annotationProcessor;

    public function __construct(AnnotationProcessor $annotationProcessor)
    {
        $this->annotationProcessor = $annotationProcessor;
    }

    public function registerRoutes(Controller $controller, \ReflectionClass $reflectionClass)
    {
        if (!empty($controller->path)) {
            $this->registerRouteGroup($controller->path, $controller->options, $reflectionClass);
        } else {
            $this->annotationProcessor->processRoutesAnnotations($reflectionClass);
        }
    }

    public function registerRouteGroup(string $path, ?array $options, \ReflectionClass $controllerClass)
    {
        $routes = service('routes');
        $routes->group($path, $options, function ($routes) use ($controllerClass) {
            $this->annotationProcessor->processRoutesAnnotations($controllerClass);
        });
    }

    public function registerRoute($annotationInstance, $method, \ReflectionClass $controllerClass)
    {
        $routes = service('routes');
        $routes->{$annotationInstance->method}(ltrim($annotationInstance->path, '/'), [
            $controllerClass->getName(),
            $method->getName()
        ], $annotationInstance->options ?? []);
    }
}