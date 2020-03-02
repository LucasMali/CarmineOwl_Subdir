<?php

namespace CarmineOwl\Subdir\Setup;

use CarmineOwl\Subdir\Model\LanguageCodes;
use CarmineOwl\Subdir\Model\ResourceModel\LanguageCodesFactory;
use CarmineOwl\Subdir\Model\ResourceModel\ValidateFactory;
use CarmineOwl\Subdir\Model\Validate;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class InstallData
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    const TEMPLATE_NAME = 'index.php.template';

    /**
     * @var ValidateFactory
     */
    private $validate;
    /**
     * @var LanguageCodes
     */
    private $languageCodes;
    /**
     * @var DirectoryList
     */
    private $directoryList;

    public function __construct(
        ValidateFactory $validate,
        LanguageCodesFactory $languageCodes,
        DirectoryList $directoryList
    ) {
        $this->validate = $validate;
        $this->languageCodes = $languageCodes;
        $this->directoryList = $directoryList;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function install(
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $_conn = $setup->getConnection();
        $setup->startSetup();
        $this->init($_conn, $context);
        $setup->endSetup();
    }

    /**
     * @param $conn
     * @param $context
     * @noinspection PhpExpressionResultUnusedInspection
     * @noinspection PhpUndefinedVariableInspection
     * @throws \Exception
     */
    private function init($conn, $context)
    {
        if (!$context->getVersion()) {
            /*
             * Install for the first subdirectory
             */
            $_fileName = __DIR__ . DIRECTORY_SEPARATOR . self::TEMPLATE_NAME;
            if (!$template = file_get_contents(
                $_fileName
            )) {
                throw new \LogicException(sprintf(
                    'Unable to load the template %s',
                    self::TEMPLATE_NAME
                ));
            }

            $_data = [
                'folder' => 'de',
                'index_php' => '\'' . $template . '\''
            ];

            /** @var Validate $this */
            $_connection = ($_validate = $this->validate->create())->getConnection();
            try {
                $_connection->beginTransaction();
                $_connection->insertMultiple(Validate::CACHE_TAG, $_data);
                $_connection->commit();
            } catch (\Exception $e) {
                $_connection->rollBack();
            }

            /*
             * Install the language to codes
             */
            $_codes = [
                ['language' => 'Bulgarian', 'code' => 'bg'],
                ['language' => 'Croatian', 'code' => 'hr'],
                ['language' => 'Czech', 'code' => 'cs'],
                ['language' => 'Danish', 'code' => 'da'],
                ['language' => 'Dutch', 'code' => 'nl'],
                ['language' => 'English', 'code' => 'en'],
                ['language' => 'Estonian', 'code' => 'et'],
                ['language' => 'Finnish', 'code' => 'fi'],
                ['language' => 'French', 'code' => 'fr'],
                ['language' => 'German', 'code' => 'de'],
                ['language' => 'Greek', 'code' => 'el'],
                ['language' => 'Hungarian', 'code' => 'hu'],
                ['language' => 'Irish', 'code' => 'ga'],
                ['language' => 'Italian', 'code' => 'it'],
                ['language' => 'Latvian', 'code' => 'lv'],
                ['language' => 'Lithuanian', 'code' => 'lt'],
                ['language' => 'Maltese', 'code' => 'mt'],
                ['language' => 'Polish', 'code' => 'pl'],
                ['language' => 'Portuguese', 'code' => 'pt'],
                ['language' => 'Romanian', 'code' => 'ro'],
                ['language' => 'Slovak', 'code' => 'sk'],
                ['language' => 'Slovenian', 'code' => 'sl'],
                ['language' => 'Spanish', 'code' => 'es'],
                ['language' => 'Swedish', 'code' => 'sv']
            ];

            $_connection = ($this->languageCodes->create())->getConnection();
            foreach ($_codes as $_data) {
                try {
                    $_connection->beginTransaction();
                    $_connection->insertMultiple(LanguageCodes::CACHE_TAG, $_data);
                    $_connection->commit();
                } catch (\Exception $e) {
                    $_connection->rollBack();
                }
            } // end foreach
        } // end init function
    }
}
