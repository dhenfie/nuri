<?php

namespace Dhenfie\Nuri\Libs;

class Section
{
    private array $section = [];

    private string $currentSection;


    public function create(string $name, string $values) : void
    {
        $this->section[$name] = $values;
    }

    public function start(string $name)
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function end()
    {
        $contents                             = $this->getContents();
        $this->section[$this->currentSection] = $contents;

        // clean and turn off output buffering
        ob_end_clean();
    }

    // public function getSection(string $name): string {
    //     // retur
    // }

    public function getContents() : string
    {
        $contents = ob_get_contents();
        return ($contents === false) ? '' : $contents;
    }

    public function getSection(string $name) : string
    {
        $contents = isset($this->section[$name]) ? $this->section[$name] : '';
        return $contents;
    }
}
