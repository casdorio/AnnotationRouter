<?php

namespace Casdorio\AnnotationRouter\Core;

use ReflectionClass;
use ReflectionMethod;
use Casdorio\AnnotationRouter\Annotations\Controller;
use Casdorio\AnnotationRouter\Annotations\Route;
use Casdorio\AnnotationRouter\Core\RouteRegistrar;
use Casdorio\AnnotationRouter\Factories\AnnotationFactory;

class AnnotationProcessor
{

    private $routeRegistrar;

    public function __construct()
    {
        $this->routeRegistrar = new RouteRegistrar($this);
    }

    public function processControllerAnnotations(ReflectionClass $reflectionClass)
    {
        $controllerAnnotations = $this->resolveAnnotationsOrAttributes($reflectionClass, Controller::class);
        $this->routeRegistrar->registerRoutes($controllerAnnotations, $reflectionClass);
    }

    public function processRoutesAnnotations(ReflectionClass $controllerClass)
    {
        $methods = $controllerClass->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            $apiEndpointAnnotations = $this->resolveAnnotationsOrAttributes($method, Route::class);
            if (empty($apiEndpointAnnotations)) {
                continue;
            }
            foreach ($apiEndpointAnnotations as $annotationInstance) {
                try {
                    $this->routeRegistrar->registerRoute($annotationInstance, $method, $controllerClass);
                } catch (\Throwable $e) {
                    echo 'Erro ao processar anotação para ' . $controllerClass->getName() . '::' . $method->getName() . ': ' . $e->getMessage();
                }
            }
        }
    }

    private function resolveAnnotationsOrAttributes($reflection, string $annotationClass): array|object
    {
        $annotations = [];
        $attribute = $reflection->getAttributes($annotationClass);

        if (!empty($attribute)) {
            $annotations = $this->getAttributesInstance($reflection, $annotationClass);
        } else {
            $annotations = $this->getDocCommentAnnotations($reflection, $annotationClass);
        }

        if ($reflection instanceof ReflectionClass) {
            return $annotations[0] ?? null;
        }

        return $annotations;
    }

    private function getDocCommentAnnotations($reflection, string $annotationClass): array
    {
        $annotations = [];
        $docComment = $reflection->getDocComment();

        if ($docComment) {
            $annotationData = AnnotationFactory::fromDocCommentForClass($docComment, $reflection, $annotationClass);

            if (!empty($annotationData)) {
                $annotations[] = new $annotationClass(...array_values((array)$annotationData));
            }
        }

        return $annotations;
    }

    private function getAttributesInstance($reflection, string $annotationClass): array
    {
        $attributes = [];
        $reflectionAttributes = $reflection->getAttributes($annotationClass);
        foreach ($reflectionAttributes as $attribute) {
            $attributes[] = $attribute->newInstance();
        }

        return $attributes;
    }
}