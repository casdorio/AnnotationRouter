<?php

namespace Casdorio\AnnotationRouter\Annotations;

use Casdorio\AnnotationRouter\Annotations\Annotations;
use Attribute;

#[Attribute]
class Controller extends Annotations
{
    public function __construct(
        public ?string $path = null,
        public ?array $options = null
    ) {}
}