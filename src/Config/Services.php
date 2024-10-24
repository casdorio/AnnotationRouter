<?php

namespace Casdorio\AnnotationRouter\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function events($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('events');
        }

        // Incluindo o arquivo de eventos do seu pacote
        require_once __DIR__ . '/Events.php';
    }
}
