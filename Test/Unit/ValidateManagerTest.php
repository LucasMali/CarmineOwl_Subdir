<?php


namespace CarmineOwl\Subdir\Test\Unit;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class ValidateManagerTest extends TestCase
{
    /**
     * @var object
     */
    private $validationManager;

    public function setUp()
    {
        $om = new ObjectManager($this);
        $this->validationManager = $om->getObject('\CarmineOwl\Subdir\Helper\ValidationManager');
    }

    public function testRun()
    {
        // TODO stub out.
        $this->assertTrue(true);
    }

    public function testBuildFile()
    {
        // TODO stub out.
    }
}
