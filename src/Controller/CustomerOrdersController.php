<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CustomerOrders Controller
 *
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
            'contain' => []
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
            if ($this->CustomerOrders->save($customerOrder)) {
                $this->Flash->success(__('The customer order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer order could not be saved. Please, try again.'));
        }
        $this->set(compact('customerOrder'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerOrder = $this->CustomerOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerOrder = $this->CustomerOrders->patchEntity($customerOrder, $this->request->getData());
            if ($this->CustomerOrders->save($customerOrder)) {
                $this->Flash->success(__('The customer order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer order could not be saved. Please, try again.'));
        }
        $this->set(compact('customerOrder'));
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
