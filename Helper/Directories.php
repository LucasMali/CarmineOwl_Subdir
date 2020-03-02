<?php


namespace CarmineOwl\Subdir;

use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class Directories
 * @package CarmineOwl\Subdir
 */
abstract class Directories
{
    /**
     * @param string $directory
     */
    public static function validate(string $directory)
    {
        is_dir($directory) ?: self::create($directory);
    }

    /**
     * @param string $directory
     */
    public static function create(string $directory)
    {
        mkdir($directory);
    }

    public static function delete(string $directory)
    {
        rmdir($directory);
    }
}
