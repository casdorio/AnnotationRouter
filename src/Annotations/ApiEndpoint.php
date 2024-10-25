<?php

namespace Casdorio\AnnotationRouter\Annotations;

use Attribute;

#[Attribute]
class ApiEndpoint extends Annotation
{
    public function __construct(
        public string $method,
        public string $path,
        public ?array $options = null
    ) {}
}
