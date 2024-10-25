<?php

namespace Casdorio\AnnotationRouter\Hooks;

use ReflectionClass;
use ReflectionMethod;
use Casdorio\AnnotationRouter\Annotations\ApiEndpoint;
use Casdorio\AnnotationRouter\Annotations\Controller;

class AnnotationProcessor
{
    public function processControllerAnnotations(ReflectionClass $reflectionClass, RouteRegistrar $routeRegistrar)
    {
        $attributes = $reflectionClass->getAttributes(Controller::class);
        foreach ($attributes as $attribute) {
            try {
                $controllerAnnotation = $attribute->newInstance();
                $routeRegistrar->registerRoutes($controllerAnnotation, $reflectionClass);
            } catch (\Throwable $e) {
                echo 'Error processing annotation for ' . $reflectionClass->getName() . ': ' . $e->getMessage();
            }
        }
    }

    public function processApiEndpointAnnotations(ReflectionMethod $method, $routes, ReflectionClass $controllerClass)
    {
        $attributes = $method->getAttributes(ApiEndpoint::class);
        foreach ($attributes as $attribute) {
            try {
                $annotationInstance = $attribute->newInstance();
                $routes->{$annotationInstance->method}(ltrim($annotationInstance->path, '/'), [
                    $controllerClass->getName(),
                    $method->getName()
                ], $annotationInstance->options ?? []);
            } catch (\Throwable $e) {
                echo 'Error processing annotation for ' . $controllerClass->getName() . '::' . $method->getName() . ': ' . $e->getMessage();
            }
        }
    }
}