<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CustomerOrders Controller
 *
 * @property \App\Model\Table\CustomerOrdersTable $CustomerOrders
 *
 * @method \App\Model\Entity\CustomerOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomerOrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $customerOrders = $this->paginate($this->CustomerOrders);

        $this->set(compact('customerOrders'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customerOrder = $this->CustomerOrders->get($id, [
            'contain' => ['products']
        ]);

        $this->set('customerOrder', $customerOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customerOrder = $this->CustomerOrders->newEntity();
        if ($this->request->is('post')) {
            $customerOrder = $this->CustomerOrders->patchEntity($customerOrder, $this->request->getData());

            $customerOrder->user_id = $this->Auth->user('id');
            if ($this->CustomerOrders->save($customerOrder)) {
                $this->Flash->success(__('The customer order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer order could not be saved. Please, try again.'));
        }

        $customers = $this->CustomerOrders->Customers->find('list');
        $products = $this->CustomerOrders->Products->find('list');
        $this->set(compact('customerOrder', 'customers', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $customerId Customer Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($customerId)
    {
        $customerOrder = $this->CustomerOrders
            ->findByCustomer_id($customerId)
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->CustomerOrders->patchEntity($customerOrder, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->CustomerOrders->save($customerOrder)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        $this->set('article', $customerOrder);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customerOrder = $this->CustomerOrders->get($id);
        if ($this->CustomerOrders->delete($customerOrder)) {
            $this->Flash->success(__('The customer order has been deleted.'));
        } else {
            $this->Flash->error(__('The customer order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }
    }
}
