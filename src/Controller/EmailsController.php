<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;

class EmailsController extends AppController{
    public function index(){
        $email = new Email('default');
        $emailaddress = $this->request->getQuery('email');
        $uuid = $this->request->getQuery('uuid');

        $confirmationlink = "http://". $_SERVER['HTTP_HOST'].$this->request->webroot."Users/confirmation?uuid=".$uuid;

        $email->to($emailaddress)->subject('Confirmation - TP1 Werner Burat')->send(
            'Your confirmation link is: ' . $confirmationlink);
    }
}
?>