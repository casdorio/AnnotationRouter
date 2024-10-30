<?php

namespace Casdorio\AnnotationRouter\Core;

use Casdorio\AnnotationRouter\Annotations\Controller;
use Casdorio\AnnotationRouter\Annotations\Annotations;

class ControllerAnnotationChecker
{
    public function hasControllerAnnotation(\ReflectionClass $reflectionClass): bool
    {
        $attributes = $reflectionClass->getAttributes(Controller::class);

        if ($attributes !== []) {
            return true;
        }

        $docComment = $reflectionClass->getDocComment();
        if ($docComment !== false) {
            $patterns = Annotations::getAnnotationPatterns();
            if (isset($patterns[Controller::class]) && preg_match($patterns[Controller::class], $docComment)) {
                return true;
            }
        }

        return false;
    }
}