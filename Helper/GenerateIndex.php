<?php

namespace CarmineOwl\Subdir\Helper;

use CarmineOwl\Subdir\Directories;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class GenerateIndex
 * @package CarmineOwl\Subdir\Helper
 */
class GenerateIndex
{
    const PARAM_RUN_CODE_PATTERN = '{{$}}';
    const STORE_CODE_PATTERN = 'elixinol_eu_(.*)';

    /**
     * @var DirectoryList
     */
    private $directoryList;

    public function __construct(
        DirectoryList $directoryList
    ) {
        $this->directoryList = $directoryList;
    }

    /**
     * @param string $index
     * @param string $code
     * @return string
     */
    public function makeIndex(string $index, string $code): string
    {
        Directories::validate();
        str_replace($index, self::PARAM_RUN_CODE_PATTERN, $code);
        return $index;
    }

    private function buildFolder(): string
    {
        $_relativePath = $this->directoryList->getRoot();

        return $_relativePath;
    }

}
