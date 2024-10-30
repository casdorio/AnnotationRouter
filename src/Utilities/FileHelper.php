<?php

namespace Casdorio\AnnotationRouter\Utilities;

class FileHelper
{
    public static function getPhpFilesInDirectory(string $directory): array
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

    public static function getClassNameFromFile(string $filePath): string
    {
        $relativePath = str_replace(APPPATH . 'Controllers/', '', $filePath);
        return 'App\\Controllers\\' . str_replace(['/', '.php'], ['\\', ''], $relativePath);
    }
}