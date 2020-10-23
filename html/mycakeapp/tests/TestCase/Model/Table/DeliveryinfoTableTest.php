<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeliveryinfoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeliveryinfoTable Test Case
 */
class DeliveryinfoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeliveryinfoTable
     */
    public $Deliveryinfo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Deliveryinfo',
        'app.Bidinfos',
        'app.Ratings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Deliveryinfo') ? [] : ['className' => DeliveryinfoTable::class];
        $this->Deliveryinfo = TableRegistry::getTableLocator()->get('Deliveryinfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Deliveryinfo);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
