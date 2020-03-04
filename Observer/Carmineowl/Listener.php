<?php

namespace CarmineOwl\Subdir\Observer\Carmineowl;

use CarmineOwl\Subdir\Model\CreateSubdirManager;
use Magento\Framework\Event\Observer;

/**
 * Class Listener
 */
class Listener implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var CreateSubdirManager
     */
    private $manager;

    public function __construct(CreateSubdirManager $manager)
    {
        $this->manager = $manager;
    }

    public function execute(Observer $observer)
    {
        $_code = $observer->getData('website')->getDataByKey('code');
        try {
            $this->manager->execute($_code);
        } catch (\Exception $e) {
            throw new \Exception(sprintf("Unable to make the subdirectory for %", $_code));
        }
    }
}
