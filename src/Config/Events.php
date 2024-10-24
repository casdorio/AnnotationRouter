<?php

namespace Casdorio\AnnotationRouter\Config;

use CodeIgniter\Config\BaseConfig;
use Casdorio\AnnotationRouter\Hooks;

class Events extends BaseConfig
{
    public function __construct()
    {
        // Aqui você pode adicionar um listener de evento para registrar as anotações
        \CodeIgniter\Events\Events::on('post_system', function () {
            $hook = new Hooks();
            $hook->registerAnnotations();
        });
    }
}
