<?php

namespace CarmineOwl\Subdir\Helper;

use CarmineOwl\Subdir\Model\LanguageCodesRepository as LanguageCodesRepository;
use CarmineOwl\Subdir\Model\ValidateFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class ValidationManager
 * @package CarmineOwl\Subdir\Helper
 */
class ValidationManager
{
    const PARAM_RUN_CODE_PATTERN = '{{$}}';
    const STORE_CODE_PATTERN = '';

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
     * GenerateIndex constructor.
     * @param DirectoryList $directoryList
     * @param LanguageCodesRepository $languageCodes
     * @param ValidateFactory $validate
     */
    public function __construct(
        DirectoryList $directoryList,
        LanguageCodesRepository $languageCodes,
        ValidateFactory $validate
    ) {
        $this->directoryList = $directoryList;
        $this->languageCodes = $languageCodes;
        $this->validate = $validate;
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function run()
    {
        // get the values
        $_validate = $this->validate->create()->getCollection();

        foreach ($_validate as $val) {
            if (!$val->getFolder()) {
                continue;
            }
            $_absoluteFolderPath = $this->directoryList->getRoot() . DIRECTORY_SEPARATOR . $val->getFolder();
            if (!Directories::isValid($_absoluteFolderPath)) {
                // Generate index.php from template
                $this->buildFile(
                    $this->cleanTheContent($val->getIndexPhp()),
                    $val->getFolder(),
                    $_absoluteFolderPath
                );
                // Transfer files, .htaccess
                copy($this->directoryList->getRoot() . DIRECTORY_SEPARATOR . 'pub' . DIRECTORY_SEPARATOR . '.htaccess',
                    $_absoluteFolderPath . DIRECTORY_SEPARATOR . '.htaccess');
            } // end valid directories
        } // end foreach
    }

    /**
     * @param string $template
     * @param string $code
     * @param string $absoluteFolderPath
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function buildFile(
        string $template,
        string $code,
        string $absoluteFolderPath
    ) {
        $_languageCode = $this->languageCodes->getByCode($code);
        $_lang = strtolower($_languageCode->getLanguage());
        $_code = self::STORE_CODE_PATTERN . $_lang;
        $template = str_replace(self::PARAM_RUN_CODE_PATTERN, $_code, $template);
        Directories::create($absoluteFolderPath);
        file_put_contents(
            $absoluteFolderPath . DIRECTORY_SEPARATOR . 'index.php',
            $template
        );
    }

    private function cleanTheContent($content)
    {
        return trim($content, '\'');
    }

}
