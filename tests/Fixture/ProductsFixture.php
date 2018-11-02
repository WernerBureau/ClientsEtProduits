<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 *
 */
class ProductsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'autoIncrement' => true, 'precision' => null, 'comment' => null],
        'type_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'price' => ['type' => 'decimal', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        'description' => ['type' => 'string', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'type_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'price' => 1.5,
                'description' => 'Lorem ipsum dolor sit amet',
                'created' => '2018-10-04 17:13:48',
                'modified' => '2018-10-04 17:13:48'
            ],
        ];
        parent::init();
    }
}
