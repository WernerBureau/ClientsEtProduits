<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Utility\Text;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function isAuthorized($user) {

        $action = $this->request->getParam('action');

        if (in_array($action, ['confirmation'])) {
            return true;
        }

        // The edit action is authorized for logged in users (super-users)
        if (in_array($action, ['edit'])) {
            if (isset($user['role']) && $user['role'] >= 3) {
                return true;
            }

            if (isset($user['role']) && $user['role'] >= 1) {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }

                $profile = $this->Users->findById($id)->first();
                return $profile->id === $user['id'];
            }
        }

        if (in_array($action, ['view'])) {
            if (isset($user['role']) && $user['role'] >= 3) {
                return true;
            }

            if (isset($user['role']) && $user['role'] >= 1) {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }

                $profile = $this->Users->findById($id)->first();
                return $profile->id === $user['id'];
            }
        }

        // The delete action is only authorized for role 3 (admins)
        if (in_array($action, ['delete'])) {
            if (isset($user['role']) && $user['role'] >= 3) {
                return true;
            }
        }
    }

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout', 'add']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($user['role'] === 1){
                    $this->Flash->success('Please activate your account. Restrictions: Can\'t add or edit anything on this website.');
                } else {
                    $this->Flash->success('You are now logged in.');
                }

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your email or password is incorrect.');
        }
    }

    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function about() {

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['provinces']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                $emailaddress = $user->get('email');
                $uuidparam = $user->get('uuid');
                return $this->redirect(['controller' => 'emails', 'action' => 'index', '?'=>['email'=>$emailaddress, 'uuid'=>$uuidparam]]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }


        // Bâtir la liste des pays
        $this->loadModel('Countries');
        $countries = $this->Countries->find('list', ['limit' => 200]);

        // Extraire le id du premier pays
        $countries = $countries->toArray();
        reset($countries);
        $country_id = key($countries);

        // Bâtir la liste des provinces reliées à cette catégorie
        $provinces = $this->Countries->Provinces->find('list', [
            'conditions' => ['Provinces.country_id' => $country_id],
        ]);


        $uuid = Text::uuid();
        $this->set(compact('user', 'uuid', 'countries', 'provinces'));
        $this->set('_serialize', ['user', 'countries', 'provinces', 'uuid']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        // Bâtir la liste des pays
        $this->loadModel('Countries');
        $countries = $this->Countries->find('list', ['limit' => 200]);

        // Extraire le id du premier pays
        $countries = $countries->toArray();
        reset($countries);
        $country_id = key($countries);

        // Bâtir la liste des provinces reliées à cette catégorie
        $provinces = $this->Countries->Provinces->find('list', [
            'conditions' => ['Provinces.country_id' => $country_id],
        ]);


        $this->set(compact('user', 'countries', 'provinces'));



    }

    public function confirmation()
    {
        $uuidparam = $this->request->getQuery('uuid');

        $user = $this->Users->findByUuid($uuidparam)->first();


        $user = $this->Users->patchEntity($user, $this->request->getData());
        $user->role = 2;

            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been confirmed.'));
                $this->Auth->setUser($user);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));


        $this -> autoRender = false;
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
