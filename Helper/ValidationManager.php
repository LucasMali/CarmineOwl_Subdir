<?php

namespace CarmineOwl\Subdir\Helper;

use CarmineOwl\Subdir\Model\ResourceModel\LanguageCodes;
use CarmineOwl\Subdir\Model\ValidateFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class ValidationManager
 * @package CarmineOwl\Subdir\Helper
 */
class ValidationManager
{
    const PARAM_RUN_CODE_PATTERN = '{{$}}';
    const STORE_CODE_PATTERN = 'elixinol_eu_(.*)';

    /**
     * @var DirectoryList
     */
    private $directoryList;
    /**
     * @var LanguageCodes
     */
    private $languageCodes;
    /**
     * @var ValidateFactory
     */
    private $validate;

    /**
     * GenerateIndex constructor.
     * @param DirectoryList $directoryList
     * @param LanguageCodes $languageCodes
     * @param ValidateFactory $validate
     */
    public function __construct(
        DirectoryList $directoryList,
        LanguageCodes $languageCodes,
        ValidateFactory $validate
    ) {
        $this->directoryList = $directoryList;
        $this->languageCodes = $languageCodes;
        $this->validate = $validate;
    }

    public function run()
    {
        // get the values
        $_validate = $this->validate->create()->getCollection();

        foreach ($_validate as $val) {
            $pause = true;
        }
        // check they exists, if not create them.
        str_replace($index, self::PARAM_RUN_CODE_PATTERN, $code);
        return $index;
    }

    private function buildFolder(): string
    {
        return $this->directoryList->getRoot();
    }
}
