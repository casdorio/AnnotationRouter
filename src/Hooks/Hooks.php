<?php

namespace Casdorio\AnnotationRouter\Hooks;

use CodeIgniter\Config\BaseConfig;
use Casdorio\AnnotationRouter\Annotations;
use CodeIgniter\Exceptions\FrameworkException;

class Hooks extends BaseConfig
{
    private $controllerHandler;
    private $routeRegistrar;

    public function __construct()
    {
        $this->controllerHandler = new ControllerHandler();
        $this->routeRegistrar = new RouteRegistrar();
    }

    public function registerAnnotations()
    {
        service('router');
        $controllerFiles = $this->getPhpFilesInDirectory(APPPATH . 'Controllers');

        if (empty($controllerFiles)) {
            throw new FrameworkException('No controller files found in ' . APPPATH . 'Controllers');
        }

        foreach ($controllerFiles as $file) {
            $className = $this->getClassNameFromFile($file);
            $reflectionClass = new \ReflectionClass($className);

            if ($this->controllerHandler->hasControllerAnnotation($reflectionClass)) {
                $this->controllerHandler->processController($reflectionClass, $this->routeRegistrar);
            }
        }
    }

    private function getClassNameFromFile(string $filePath): string
    {
        $relativePath = str_replace(APPPATH . 'Controllers/', '', $filePath);
        return 'App\\Controllers\\' . str_replace(['/', '.php'], ['\\', ''], $relativePath);
    }

    private function getPhpFilesInDirectory(string $directory): array
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
        $phpFiles = [];

        foreach ($iterator as $file) {
            if (!$file->isDir() && pathinfo($file->getFilename(), PATHINFO_EXTENSION) === 'php') {
                $phpFiles[] = $file->getPathname();
            }
        }

        return $phpFiles;
    }
}