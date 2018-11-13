<?php
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    use \Crud\Controller\ControllerTrait;

    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
    }

    public function isAuthorized($user) {
        // By default deny access.
        return false;
    }

}