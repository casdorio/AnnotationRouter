<?php

namespace Casdorio\AnnotationRouter\Annotations;

#[Attribute]
class ApiEndpoint
{
    public function __construct(
        public string $method,
        public string $path,
    ) {}
}
