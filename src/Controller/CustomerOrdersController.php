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

    public function isAuthorized($user) {

        $action = $this->request->getParam('action');


        // The view action is only authorized for logged in users
        if (in_array($action, ['view'])) {
            if (isset($user['role']) && $user['role'] >= 1 ) {
                return true;
            }
        }

        // The add and edit action is only authorized for role 2 and 3 (super-users)
        if (in_array($action, ['add', 'edit'])) {
            if (isset($user['role']) && $user['role'] >= 2) {
                return true;
            }
        }

        // The delete action is only authorized for role 3 (admin)
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
            'contain' => ['order_items', 'products']
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
            if ($this->CustomerOrders->save($customerOrder , ['associated' => ['Order_items._joinData.quantity']])) {

                $orderItem = $this->CustomerOrders->Order_items->newEntity();
                $orderItem->order_id = $customerOrder->get('id');
                $orderItem->product_id = $this->request->getData('products._ids.0');
                $orderItem->quantity = $this->request->getData('order_items.quantity');
                $orderItem->total = $this->CustomerOrders->Order_Items->Products->findById($orderItem->product_id)->first()->get('price') * $orderItem->quantity;

                $this->CustomerOrders->Order_items->save($orderItem);
                $this->Flash->success(__('The customer order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer order could not be saved. Please, try again.'));
        }

        $customers = $this->CustomerOrders->Customers->find('list');
        $products = $this->CustomerOrders->Order_Items->Products->find('list');
        $this->set(compact('customerOrder', 'customers', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $customerId Customer Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerOrder = $this->CustomerOrders->get($id, [
            'contain' => ['order_items', 'products', 'customers']
        ]);


        if ($this->request->is(['post', 'put'])) {
            $this->CustomerOrders->patchEntity($customerOrder, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->CustomerOrders->save($customerOrder)) {
                $this->Flash->success(__('Your customer order has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your customer order.'));
        }

        $customers = $this->CustomerOrders->Customers->find('list');
        $this->set('customerOrder', $customerOrder);
        $this->set('customers', $customers);

        $products = $this->CustomerOrders->Order_Items->Products->find('list');
        $this->set('products', $products);
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
}
