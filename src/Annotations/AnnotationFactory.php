<?php

namespace Casdorio\AnnotationRouter\Annotations;

use ReflectionClass;
use ReflectionMethod;

class AnnotationFactory
{
    /**
     * Converte um docComment para uma instância da anotação.
     * 
     * @param string $docComment
     * @return Annotation|null
     */
    public static function fromDocComment(string $docComment): ?Annotation
    {
        foreach (Annotation::getAnnotationPatterns() as $annotationClass => $pattern) {
            if (preg_match($pattern, $docComment, $matches)) {
                $reflection = new ReflectionClass($annotationClass);

                $args = [];
                foreach ($reflection->getConstructor()->getParameters() as $index => $param) {
                    $paramName = $param->getName();
                    $args[$paramName] = isset($matches[$index + 1]) ? trim($matches[$index + 1], '"\'') : null;
                }

                if (isset($args['options']) && is_string($args['options'])) {
                    $args['options'] = json_decode($args['options'], true) ?? [];
                }

                return $reflection->newInstanceArgs($args);
            }
        }
        return null;
    }

    /**
     * Obtém anotações de atributos ou do docComment.
     * 
     * @param ReflectionClass|ReflectionMethod $reflection
     * @param string $annotationClass
     * @return Annotation|null
     */
    public static function getAnnotation(ReflectionClass|ReflectionMethod $reflection, string $annotationClass): ?Annotation
    {
        // Primeiro tenta obter os atributos
        $attributes = $reflection->getAttributes($annotationClass);

        // Se não houver atributos, tenta converter o docComment em anotações
        if (empty($attributes)) {
            $docComment = $reflection->getDocComment();
            if ($docComment !== false) {
                return self::fromDocComment($docComment);
            }
        }

        // Se houver atributos, retorna a instância da anotação
        if (!empty($attributes)) {
            return $attributes[0]->newInstance();
        }

        return null;
    }
}
