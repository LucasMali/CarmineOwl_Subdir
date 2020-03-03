<?php

namespace CarmineOwl\Subdir\Observer\Carmineowl;

use CarmineOwl\Subdir\Model\Subdirectories\CreateSubdirManager;


/**
 * Class Listener
 */
class Listener implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var CreateSubdirManager
     */
    private $createSubdirManager;

    public function __construct(
        CreateSubdirManager $createSubdirManager
    ) {
        $this->createSubdirManager = $createSubdirManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_code = $observer->getData('website')->getDataByKey('code');
        try {
            $this->createSubdirManager->execute($_code);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
