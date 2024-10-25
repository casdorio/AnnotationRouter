<?php

namespace Casdorio\AnnotationRouter\Annotations;

abstract class Annotation
{
    /**
     * Retorna os padrões regex para identificar cada anotação.
     * 
     * @return array
     */
    public static function getAnnotationPatterns(): array
    {
        return [
            Controller::class => '/@Controller\s*\(path=["\']?(.*?)["\']?,?\s*options=(\{.*?\})?\)/',
            ApiEndpoint::class => '/@ApiEndpoint\s*\(method=["\']?(.*?)["\']?,\s*path=["\']?(.*?)["\']?(,?\s*options=(\{.*?\}))?\)/',
            // Adicione novas anotações conforme necessário
        ];
    }
}
