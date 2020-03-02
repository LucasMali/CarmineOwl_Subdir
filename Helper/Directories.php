<?php


namespace CarmineOwl\Subdir\Helper;


/**
 * Class Directories
 * @package CarmineOwl\Subdir
 */
abstract class Directories
{
    /**
     * @param string $directory
     * @return bool
     */
    public static function isValid(string $directory)
    {
        return is_dir($directory);
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
