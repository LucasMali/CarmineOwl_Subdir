<?php

namespace CarmineOwl\Subdir\Model;

use CarmineOwl\Subdir\Model\LanguageCodesRepository as LanguageCodesRepository;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class ValidationManager
 * @package CarmineOwl\Subdir\Helper
 */
class ValidationManager
{
    /**
     * @var DirectoryList
     */
    private $directoryList;
    /**
     * @var LanguageCodesRepository
     */
    private $languageCodes;
    /**
     * @var ValidateFactory
     */
    private $validate;
    /**
     * @var FileBuilder
     */
    private $fileBuilder;

    /**
     * GenerateIndex constructor.
     * @param DirectoryList $directoryList
     * @param LanguageCodesRepository $languageCodes
     * @param ValidateFactory $validate
     * @param FileBuilder $fileBuilder
     */
    public function __construct(
        DirectoryList $directoryList,
        LanguageCodesRepository $languageCodes,
        ValidateFactory $validate,
        FileBuilder $fileBuilder
    ) {
        $this->directoryList = $directoryList;
        $this->languageCodes = $languageCodes;
        $this->validate = $validate;
        $this->fileBuilder = $fileBuilder;
    }

    /**
     * Do not use yet.
     */
    public function execute()
    {
        // get the values
        $_validate = $this->validate->create()->getCollection();

        foreach ($_validate as $val) {
            if (!$val->getFolder()) {
                continue;
            }
            $_absoluteFolderPath = $this->directoryList->getRoot() . DIRECTORY_SEPARATOR . $val->getFolder();
            if (!Directories::exists($_absoluteFolderPath)) {
                // Generate index.php from template
                $this->fileBuilder->execute(
                    $this->cleanTheContent($val->getIndexPhp()),
                    $val->getFolder(),
                    $_absoluteFolderPath,
                    $this->directoryList->getRoot()
                );
            }
        }
    }

    private function cleanTheContent($content)
    {
        return trim($content, '\'');
    }
}
