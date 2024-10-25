<?php

namespace Casdorio\AnnotationRouter\Hooks;

class RouteGroupRegistrar
{
    public function registerRouteGroup(string $path, array $options, \ReflectionClass $controllerClass)
    {
        $routes = service('routes');
        $groupOptions = ['namespace' => $options['namespace'] ?? ''];

        $routes->group($path, $groupOptions, function ($routes) use ($controllerClass) {
            foreach ($controllerClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                (new RouteRegistrar())->registerApiEndpoints($method, $routes, $controllerClass);
            }
        });
    }
}