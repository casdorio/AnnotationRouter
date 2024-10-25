<?php

namespace Casdorio\AnnotationRouter\Hooks;

use ReflectionClass;
use ReflectionMethod;
use Casdorio\AnnotationRouter\Annotations\AnnotationFactory;
use Casdorio\AnnotationRouter\Annotations\Controller;
use Casdorio\AnnotationRouter\Annotations\ApiEndpoint;
use Casdorio\AnnotationRouter\Hooks\RouteRegistrar;

class AnnotationProcessor
{
    public function processControllerAnnotations(ReflectionClass $reflectionClass, RouteRegistrar $routeRegistrar)
    {
        $controllerAnnotation = AnnotationFactory::getAnnotation($reflectionClass, Controller::class);

        if ($controllerAnnotation) {
            try {
                $routeRegistrar->registerRoutes($controllerAnnotation, $reflectionClass);
            } catch (\Throwable $e) {
                echo 'Error processing annotation for ' . $reflectionClass->getName() . ': ' . $e->getMessage();
            }
        }
    }

    public function processApiEndpointAnnotations(ReflectionMethod $method, $routes, ReflectionClass $controllerClass)
    {
        $apiEndpointAnnotation = AnnotationFactory::getAnnotation($method, ApiEndpoint::class);

        if ($apiEndpointAnnotation) {
            try {
                $routes->{$apiEndpointAnnotation->method}(ltrim($apiEndpointAnnotation->path, '/'), [
                    $controllerClass->getName(),
                    $method->getName()
                ], $apiEndpointAnnotation->options ?? []);
            } catch (\Throwable $e) {
                echo 'Error processing annotation for ' . $controllerClass->getName() . '::' . $method->getName() . ': ' . $e->getMessage();
            }
        }
    }
}
