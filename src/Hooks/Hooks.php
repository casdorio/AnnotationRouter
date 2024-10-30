<?php

namespace Casdorio\AnnotationRouter\Hooks;

use CodeIgniter\Config\BaseConfig;
use Casdorio\AnnotationRouter\Core\ControllerProcessor;

class Hooks extends BaseConfig
{
    private $ControllerProcessor;

    public function __construct()
    {
        $this->ControllerProcessor = new ControllerProcessor();
    }

    public function registerAnnotations()
    {
        service('router');

        if (ENVIRONMENT === 'development') {
            $routes = service('routes');
            $routes->get('routes', '\Casdorio\AnnotationRouter\Controllers\RoutesController::index');
        }

        $this->ControllerProcessor->processControllers(APPPATH . 'Controllers');
    }
}