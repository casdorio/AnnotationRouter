<?php

namespace Casdorio\AnnotationRouter\Core;

use CodeIgniter\Exceptions\FrameworkException;
use Casdorio\AnnotationRouter\Utilities\FileHelper;

class ControllerProcessor
{
    private $controllerAnnotationChecker;
    private $annotationProcessor;

    public function __construct()
    {
        $this->controllerAnnotationChecker = new ControllerAnnotationChecker();
        $this->annotationProcessor = new AnnotationProcessor();
    }

    public function processControllers(string $directory)
    {

        $controllerFiles = FileHelper::getPhpFilesInDirectory($directory);

        if ($controllerFiles === []) {
            throw new FrameworkException('No controller files found in ' . $directory);
        }

        foreach ($controllerFiles as $file) {
            $className = FileHelper::getClassNameFromFile($file);
            $reflectionClass = new \ReflectionClass($className);
            if ($this->controllerAnnotationChecker->hasControllerAnnotation($reflectionClass)) {
                $this->annotationProcessor->processControllerAnnotations($reflectionClass);
            }
        }
    }
}