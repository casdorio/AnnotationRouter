<?php

namespace Casdorio\AnnotationRouter\Config;

use CodeIgniter\Config\BaseService;
use Casdorio\AnnotationRouter\Hooks\Hooks;

class Services extends BaseService
{
    public static function hooks($getShared = true)
    {
        print_r('hooks');
        die;
        if ($getShared) {
            return static::getSharedInstance('hooks');
        }

        return new Hooks();
    }
}