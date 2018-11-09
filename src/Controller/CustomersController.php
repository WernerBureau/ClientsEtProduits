<?php
namespace App\Controller;

use App\Controller\AppController;

class CustomersController extends AppController
{
    public $paginate = [
        'page' => 1,
        'fields' => [
            'id', 'name', 'email', 'number', 'phone'
        ],
        'sortWhitelist' => [
            'id', 'name', 'email'
        ]
    ];
}