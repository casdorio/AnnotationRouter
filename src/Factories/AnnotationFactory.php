<?php

namespace Casdorio\AnnotationRouter\Factories;

use Casdorio\AnnotationRouter\Annotations\Annotations;
use ReflectionClass;
use ReflectionMethod;

class AnnotationFactory
{
    public static function fromDocCommentForClass(string $docComment, $reflection, string $annotation): ?Annotations
    {
        if (preg_match(Annotations::getAnnotationPatterns()[$annotation], $docComment, $matches)) {
            return self::createAnnotationInstance($annotation, $matches);
        }
        return null;
    }

    private static function createAnnotationInstance(string $annotation, array $matches): object
    {

        $reflection = self::getReflection($annotation);
        if ($reflection === null) {
            echo 'Annotation not found';
            return null;
        }
        $args = [];
        foreach ($reflection->getConstructor()->getParameters() as $index => $param) {
            $args[$param->getName()] = $matches[$index + 1] ?? null;
        }

        if (isset($args['options']) && is_string($args['options'])) {
            preg_match_all("/'([^']+)' => '([^']+)'/", $args['options'], $optionMatches, PREG_SET_ORDER);
            $optionsArray = [];

            foreach ($optionMatches as $match) {
                $optionsArray[$match[1]] = $match[2] . ',';
            }
            $args['options'] = $optionsArray;
        }

        return $reflection->newInstanceArgs($args);
    }

    private static function getReflection(string $annotation)
    {
        if (class_exists($annotation)) {
            return new ReflectionClass($annotation);
        } elseif (method_exists($annotation, '__construct')) {
            return new ReflectionMethod($annotation);
        }

        return null;
    }
}
