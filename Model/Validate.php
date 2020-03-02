<?php
namespace CarmineOwl\Subdir\Model;

/**
 * Class Validate
 */
class Validate extends \Magento\Framework\Model\AbstractModel implements
    \CarmineOwl\Subdir\Api\Data\ValidateInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'carmineowl_subdir_validate';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\CarmineOwl\Subdir\Model\ResourceModel\Validate::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
