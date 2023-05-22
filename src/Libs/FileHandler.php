<?php

namespace Dhenfie\Nuri\Libs;

use Exception;

class FileHandler
{
    public readonly string $viewPath;

    private string $fileExt = '.php';

    public function __construct(string $viewPath)
    {
        if ($this->checkPath($viewPath)) {
            $this->viewPath = realpath($viewPath);
        }
    }

    private function checkPath(string $path): bool
    {
        $dir = realpath($path);
        if (! is_dir($path)) {
            return false;
        }
        return true;
    }

    private function formatPath(string $filepath): string
    {
        $validPath = str_replace('.', DIRECTORY_SEPARATOR, $filepath);
        return $validPath;
    }

    public function fileExist(string $path): bool
    {
        $filename = $this->viewPath . DIRECTORY_SEPARATOR . $this->formatPath($path) . $this->fileExt;
        if (file_exists($filename)) {
            return true;
        }
        return false;
    }

    public function include(string $filename, array $data = null): void
    {
        $fullpath = $this->viewPath . DIRECTORY_SEPARATOR . $this->formatPath($filename) . $this->fileExt;

        if ($this->fileExist($filename)) {

            if (is_array($data) && ! empty($data)) {
                extract($data);
            }

            require($fullpath);

        } else {

            throw new Exception(sprintf('failed include file %s', $this->formatPath($filename) . '.php'));
        }
    }
}
