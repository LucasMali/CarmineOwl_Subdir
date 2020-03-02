<?php
namespace CarmineOwl\Subdir\Model;

/**
 * Class LanguageCodes
 */
class LanguageCodes extends \Magento\Framework\Model\AbstractModel implements
    \CarmineOwl\Subdir\Api\Data\LanguageCodesInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'carmineowl_subdir_languagecodes';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\CarmineOwl\Subdir\Model\ResourceModel\LanguageCodes::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
