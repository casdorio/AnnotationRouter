<?php

namespace Casdorio\AnnotationRouter\Config;

use CodeIgniter\Events\Events;
use Casdorio\AnnotationRouter\Hooks;

// Depuração para verificar se o arquivo foi carregado
var_dump("Arquivo Events carregado"); 

Events::on('pre_system', function () {
    // Depuração para verificar se o hook pre_system está sendo disparado
    var_dump("Hook pre_system acionado");
    
    (new Hooks())->registerAnnotations();
});
