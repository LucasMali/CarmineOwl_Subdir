<?php

namespace CarmineOwl\Subdir\Setup;

use CarmineOwl\Subdir\Model\ResourceModel\ValidateFactory;

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

    public function __construct(ValidateFactory $validate)
    {
        $this->validate = $validate;
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
            if (!$template = file_get_contents(self::TEMPLATE_NAME)) {
                throw new \LogicException(sprintf('Unable to load the template %s',
                    self::TEMPLATE_NAME))
            }

            $_data = [
                'folder' => 'de',
                'index_php' => '\'' . $template . '\''
            ];

            $_valdate = $this->validate->create();
            $_valdate->addData($_data);
            $this->validate->save($_valdate);

            /*
             * Install the language to codes
             */
            $_codes = [
                'Bulgarian' => 'bg',
                'Croatian' => 'hr',
                'Czech' => 'cs',
                'Danish' => 'da',
                'Dutch' => 'nl',
                'English' => 'en',
                'Estonian' => 'et',
                'Finnish' => 'fi',
                'French' => 'fr',
                'German' => 'de',
                'Greek' => 'el',
                'Hungarian' => 'hu',
                'Irish' => 'ga',
                'Italian' => 'it',
                'Latvian' => 'lv',
                'Lithuanian' => 'lt',
                'Maltese' => 'mt',
                'Polish' => 'pl',
                'Portuguese' => 'pt',
                'Romanian' => 'ro',
                'Slovak' => 'sk',
                'Slovenian' => 'sl',
                'Spanish' => 'es',
                'Swedish' => 'sv'
            ];

            // FIXME add in the language codes module
        }
    }
}
