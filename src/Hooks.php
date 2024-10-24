<?php

namespace Casdorio\AnnotationRouter;

use CodeIgniter\Config\BaseConfig;
use ReflectionClass;
use ReflectionMethod;
use Casdorio\AnnotationRouter\Annotations\ApiEndpoint;
use Config\Services;

class Hooks extends BaseConfig
{
    public function registerAnnotations()
    {
        $controllers = glob(APPPATH . 'Controllers/*/*.php');

        foreach ($controllers as $controllerFile) {
            $className = $this->getClassNameFromFile($controllerFile);
            $reflectionClass = new ReflectionClass($className);

            foreach ($reflectionClass->getMethods() as $method) {
                $attributes = $method->getAttributes(ApiEndpoint::class);
                foreach ($attributes as $attribute) {
                    $instance = $attribute->newInstance();
                    $this->registerRoute($instance, $method, $reflectionClass->getShortName());
                }
            }
        }
    }

    private function getClassNameFromFile(string $filePath): string
    {
        return 'App\\Controllers\\' . basename($filePath, '.php');
    }

    private function registerRoute(ApiEndpoint $endpoint, ReflectionMethod $method, string $controllerName)
    {
        $routes = Services::routes();
        $routeMethod = strtoupper($endpoint->method);
        $routePath = trim($endpoint->path, '/');

        $routes->{$routeMethod}($routePath, "{$controllerName}::{$method->getName()}");
    }
}
