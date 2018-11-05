<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */


//Ajout des scripts Bootstrap et jquery
echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
echo $this->Html->script([
    'https://code.jquery.com/jquery-3.3.1.slim.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'
]);

$cakeDescription = 'Werner Burat - Clients et Produits';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

    <?php $loguser = $this->request->session()->read('Auth.User');?>

    <?php if ($loguser):
    $user = $loguser['email'];
    $role = $loguser['role'];
    $emailaddress = $loguser['email'];
    $uuidparam = $loguser['uuid'];
    endif;?>

    <!-- Début navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?= $this->fetch('title') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Boutons de gauche -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <?= $this->Html->link(__('Home'), ['controller' => 'Customers', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                        <?= $this->Html->link(__('Customer orders'), ['controller' => 'CustomerOrders', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                        <?= $this->Html->link(__('Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                        <?= $this->Html->link(__('Product types'), ['controller' => 'ProductTypes', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                        <?= $this->Html->link(__('Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                        <?php if ($role === 3): ?>
                            <?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                        <?php endif;?>
                        <div class="dropdown-divider"></div>
                        <?= $this->Html->link(__('About'), ['controller' => 'Users', 'action' => 'about'], ['class' => 'dropdown-item']) ?>
                    </div>
                </li>
            </ul>

            <!-- Boutons de droite -->
            <ul class="navbar-nav ml-auto">

                <?php if ($role === 1): ?>
                    <li class="nav-item">
                        <?= $this->Html->link(__('Please validate your account. Click to resend confirmation email.'),
                            ['controller' => 'emails', 'action' => 'index', '?'=>['email'=>$emailaddress, 'uuid'=>$uuidparam]],
                            ['class' => 'nav-link']); ?>
                    </li>
                <?php endif;?>
                <?php if ($loguser): ?>
                    <li class="nav-item">
                        <?= $this->Html->link(($user), ['controller' => 'Users', 'action' => 'view', $loguser['id']], ['class' => 'nav-link']);?>
                    </li>

                    <li class="nav-item">
                        <?= $this->Html->link(__(' Logout '), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']);?>
                    </li>

                <?php else: ?>
                <li class="nav-item">
                    <?= $this->Html->link(__(' Login '), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']);?>
                </li>

                <?php endif;?>

                <span class="border-right"></span>

                <li class="nav-item">
                    <?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['class' => 'nav-link'], ['escape' => false]); ?>
                </li>

                <li class="nav-item">
                    <?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['class' => 'nav-link'], ['escape' => false]); ?>
                </li>

                <li class="nav-item">
                    <?= $this->Html->link('Deutsch', ['action' => 'changeLang', 'de_DE'], ['class' => 'nav-link'], ['escape' => false]); ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Fin navbar Bootstrap -->

    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
