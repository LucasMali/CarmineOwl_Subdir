<?php


namespace CarmineOwl\Subdir\Model;


/**
 * Class Directories
 * @package CarmineOwl\Subdir
 */
abstract class Directories
{
    const MAGENTO_DIRECTORY_PERMISSION = 0755;
    const MAGENTO_FILE_PERMISSION = 0644;
    const RECURSIVE = true;

    /**
     * @param string $directory
     * @return bool
     */
    public static function exists(string $directory)
    {
        return is_dir($directory);
    }

    /**
     * @param string $directory
     */
    public static function create(string $directory)
    {
        mkdir($directory, self::MAGENTO_DIRECTORY_PERMISSION, self::RECURSIVE);
    }

    public static function delete(string $directory)
    {
        rmdir($directory);
    }
}
