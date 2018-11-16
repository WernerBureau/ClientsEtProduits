<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\products_filesComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\products_filesComponent Test Case
 */
class products_filesComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\products_filesComponent
     */
    public $products_files;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->products_files = new products_filesComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->products_files);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
