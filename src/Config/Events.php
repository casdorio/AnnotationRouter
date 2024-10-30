<?php

namespace Casdorio\AnnotationRouter\Config;

use CodeIgniter\Events\Events;
use Casdorio\AnnotationRouter\Hooks\Hooks;

Events::on(
    'pre_system', function (): void {
        (new Hooks())->registerAnnotations();
    }
);
