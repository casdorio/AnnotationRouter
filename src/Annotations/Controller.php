<?php

namespace Casdorio\AnnotationRouter\Annotations;

use Attribute;

#[Attribute]
class Controller
{
    public function __construct(
        public ?string $path = '',
        public ?array $options = []
    ) {}
}