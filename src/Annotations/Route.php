<?php

namespace Casdorio\AnnotationRouter\Annotations;

use Casdorio\AnnotationRouter\Annotations\Annotations;
use Attribute;

#[Attribute]
class Route extends Annotations
{
    public function __construct(
        public string $method,
        public string $path,
        public ?array $options = []
    ) {
    }
}
