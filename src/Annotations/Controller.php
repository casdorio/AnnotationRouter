<?php

namespace Casdorio\AnnotationRouter\Annotations;

use Attribute;

#[Attribute]
class Controller extends Annotation
{
    public function __construct(
        public ?string $path = '',
        public ?array $options = []
    ) {}
}
