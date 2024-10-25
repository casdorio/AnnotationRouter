<?php

namespace Casdorio\AnnotationRouter\Hooks;

use Casdorio\AnnotationRouter\Annotations\Controller;

class ControllerHandler
{
    private $annotationProcessor;

    public function __construct()
    {
        $this->annotationProcessor = new AnnotationProcessor();
    }

    public function hasControllerAnnotation(\ReflectionClass $reflectionClass): bool
    {
        return !empty($reflectionClass->getAttributes(Controller::class));
    }

    public function processController(\ReflectionClass $reflectionClass, RouteRegistrar $routeRegistrar)
    {
        $this->annotationProcessor->processControllerAnnotations($reflectionClass, $routeRegistrar);
    }
}