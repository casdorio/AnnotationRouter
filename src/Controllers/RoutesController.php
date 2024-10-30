<?php

namespace Casdorio\AnnotationRouter\Controllers;

use CodeIgniter\Controller;

class RoutesController extends Controller
{
    public function index()
    {

        $routes = service('routes');
        $routes->loadRoutes();

        echo '<pre>';
        print_r('routes');
        print_r($routes->getRoutes());
        // $registeredRoutes = [];

        // foreach ($routes->getRoutes() as $route => $handler) {
        //     $registeredRoutes[] = [
        //         'route' => $route,
        //         'handler' => $handler,
        //         'methods' => $routes->getMethods($route),
        //     ];
        // }

        // print_r($registeredRoutes);
    }
}