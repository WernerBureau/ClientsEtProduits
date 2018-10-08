<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{

    public function initialize() {
        parent::initialize();
    }

    public function isAuthorized($user) {

        $action = $this->request->getParam('action');

        // The add action is only authorized for logged in users
        if (in_array($action, ['view'])) {
            if (isset($user['role']) && $user['role'] >= 1) {
                return true;
            }
        }

        // The add action is only authorized for logged in users
        if (in_array($action, ['add'])) {
            if (isset($user['role']) && $user['role'] >= 1) {
                return true;
            }
        }

        // The edit action is only authorized for role 2 and 3 (super-users)
        if (in_array($action, ['edit'])) {
            if (isset($user['role']) && $user['role'] >= 2) {
                return true;
            }
        }

        // The delete action is only authorized for role 3 (admins)
        if (in_array($action, ['delete'])) {
            if (isset($user['role']) && $user['role'] >= 3) {
                return true;
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['files', 'product_types']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            $product->user_id = $this->Auth->user('id');
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $types = $this->Products->Product_Types->find('list');
        $files = $this->Products->files->find('list');

        $this->set(compact('product', 'types', 'files'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['product_types', 'files']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $types = $this->Products->Product_Types->find('list');
        $files = $this->Products->files->find('list');

        $this->set(compact('product', 'types', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
