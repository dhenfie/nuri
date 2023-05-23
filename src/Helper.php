<?php

use Dhenfie\Nuri\Nuri;

if (!function_exists('section')) {

    /**
     * Create block section
     *
     * @param string $name
     * @param string|null $value
     * @return void
     */
    function section(string $name, string $value = null): void
    {
        $nuri = Nuri::getInstance();
        if (is_null($value)) {
            $nuri->section->start($name);
        } else {
            $nuri->section->create($name, $value);
        }
    }
}

if (!function_exists('stopSection')) {

    /**
     * End or stop block section
     *
     * @return void
     */
    function endSection()
    {
        $nuri = Nuri::getInstance();
        $nuri->section->end();
    }
}

if (!function_exists('renderSection')) {

    /**
     * Get or render block section
     *
     * @param string $name
     * @return string
     */
    function renderSection($name): string
    {
        $nuri = Nuri::getInstance();
        return $nuri->section->getSection($name);
    }
}

if (!function_exists('includeTheme')) {

    /**
     * Include theme
     *
     * @param string $filename
     * @param array|null $data
     * @return void
     */
    function includeTheme(string $filename, array $data = null): void
    {
        $nuri = Nuri::getInstance();
        $nuri->file->include($filename, $data);
    }
}

if (!function_exists('extendTheme')) {

    /**
     * Extending master template
     *
     * @param string $parent
     * @return void
     * @throws Exception
     */
    function extendTheme(string $parent): void
    {
        $nuri = Nuri::getInstance();
        $nuri->extend($parent);
    }
}
