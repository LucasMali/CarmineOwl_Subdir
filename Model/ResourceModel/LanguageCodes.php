<?php
namespace CarmineOwl\Subdir\Model\ResourceModel;

/**
 * Class LanguageCodes
 */
class LanguageCodes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init('carmineowl_subdir_languagecodes', 'languagecodes_id');
    }
}
