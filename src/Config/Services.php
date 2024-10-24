<?php

namespace Casdorio\AnnotationRouter\Config;

use Config\Services as BaseServices;
use Casdorio\AnnotationRouter\Hooks;

class Services extends BaseServices
{
    public static function hooks()
    {
        return new Hooks();
    }
}
