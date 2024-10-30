<?php

namespace Casdorio\AnnotationRouter\Annotations;

use Casdorio\AnnotationRouter\Annotations\Route;
use Casdorio\AnnotationRouter\Annotations\Controller;

abstract class Annotations
{
    public static function getAnnotationPatterns(): array
    {
        return [
            Controller::class => '/@Controller(?:\s*\(\s*path[=:]["\']?(.*?)["\']?(?:,\s*options[=:](\{.*?\}|\[.*?\]))?\s*\))?/',
            Route::class => '/@Route\s*\(\s*method[=:]["\']?(.*?)["\']?,\s*path[=:]["\']?(.*?)["\']?\s*(?:,\s*options[=:](\{.*?\}|\[.*?\]))?\s*\)/',
        ];
    }
}