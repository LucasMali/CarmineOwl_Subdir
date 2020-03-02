<?php
namespace CarmineOwl\Subdir\Model\ResourceModel\LanguageCodes;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(
            \CarmineOwl\Subdir\Model\LanguageCodes::class,
            \CarmineOwl\Subdir\Model\ResourceModel\LanguageCodes::class
        );
    }
}
