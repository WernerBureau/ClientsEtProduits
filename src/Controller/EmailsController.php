<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;

class EmailsController extends AppController{
    public function index(){
        $email = new Email('default');
        $emailaddress = $this->request->getQuery('email');
        $uuid = $this->request->getQuery('uuid');

        $email->to($emailaddress)->subject('Essai de CakePHP Mailer')->send(
            'Your confirmation link is: localhost/ClientsEtProduits/Users/confirmation?uuid='.$uuid);
    }
}
?>