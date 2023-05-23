<?php

namespace Dhenfie\Nuri;

use Dhenfie\Nuri\Libs\FileHandler;
use Dhenfie\Nuri\Libs\Section;
use Exception;

final class Nuri
{
    private string $master;

    public readonly Section $section;

    public readonly FileHandler $file;

    private static self $instance;

    public function __construct(string $viewPath)
    {
        $this->file     = new FileHandler($viewPath);
        $this->section  = new Section();
        self::$instance = $this;
    }

    public function render(string $filename, array $data = null): void
    {
        $this->file->include($filename, $data);

        if (isset($this->master)) {
            $this->file->include($this->master);
        }
    }

    public function extend(string $parent)
    {
        if ($this->file->fileExist($parent)) {
            $this->master = $parent;
        } else {
            throw new Exception(sprintf('invalid master tempate %s or file not found !', basename($parent)));
        }
    }

    public function getMaster(): string
    {
        return $this->master;
    }
    public static function getInstance(): self
    {
        return self::$instance;
    }

}
