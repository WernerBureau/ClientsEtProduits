<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProductsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProductsController Test Case
 */
class ProductsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.products',
        'app.users',
        'app.productTypes'
    ];

    public function setUp(){
        parent::setUp();

        $this->Products = TableRegistry::get('Products');
        $this->Product_Types = TableRegistry::get('Product_Types');
        $users = TableRegistry::get('users');

        $admin = $users->find('all', ['conditions' => ['Users.role' => 3]])->first()->toArray();
        $reguser = $users->find('all', ['conditions' => ['Users.role' => 1]])->first()->toArray();

        $this->AuthAdmin = [
            'Auth'=>[
                'User' => $admin
            ]
        ];

        $this->AuthRegUser = [
            'Auth' => [
                'User' => $reguser
            ]
        ];
    }

    public function tearDown(){
        unset($this->AuthAdmin);
        unset($this->AuthClient);
        parent::tearDown();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIsAuthorized(){
        $this->session($this->AuthRegUser);
        $this->delete('/products/edit/1');
        $this->assertSession('You are not authorized to access that location.', 'Flash.flash.0.message');
    }

    public function testIndex()
    {
        $this->session($this->AuthAdmin);
        $this->get('/products');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session($this->AuthAdmin);
        $this->get('/products/view/1');
        $this->assertResponseContains('Product name');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->session($this->AuthAdmin);
        $this->get('/products/add');
        $this->assertResponseOk();

        $data = [
            'id' => 2,
            'type_id' => 1,
            'name' => 'Second product',
            'price' => 2.5,
            'description' => 'Second product description',
            'created' => '2018-10-04 17:13:48',
            'modified' => '2018-10-04 17:13:48'
        ];

        $this->post('/products/add', $data);
        $this->assertResponseSuccess();

        $query = $this->Products->find('all', ['conditions' => ['Products.id' => $data['id']]]);
        $this->assertNotEmpty($query);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session($this->AuthAdmin);
        $this->get('/products/edit');

        $product = $this->Products->find('all')->first();
        $nameEdit = "edited product";

        $product->name = $nameEdit;
        $productArray = $product->toArray();

        $this->post('/products/edit/' . $product->id, $productArray);

        $this->assertResponseSuccess();
        $query = $this->Products->find('all', ['conditions' => ['Products.id' => $product->id]])->first();
        $this->assertEquals( $nameEdit, $query->name);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session($this->AuthAdmin);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->delete('/products/delete/1');
        $this->assertResponseSuccess();

        $query = $this->Products->find('all', ['conditions' => ['Products.id' => 1]])->first();
        $this->assertEmpty($query);
    }
}
