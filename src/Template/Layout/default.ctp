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

$cakeDescription = 'CakePHP: the rapid development php framework';
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
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>

        <div class="top-bar-section">
            <ul class="right">
                <li>
                    <?= $this->Html->link('Home', ['controller' => 'Customers', 'action' => 'index']) ?>
                </li>

            <?php
            $loguser = $this->request->session()->read('Auth.User');
             if ($loguser) {
                $user = $loguser['email'];
                $role = $loguser['role'];
                $emailaddress = $loguser['email'];
                $uuidparam = $loguser['uuid'];

                if ($role === 1){
                    echo '<li>';
                    echo $this->Html->link('Please validate your account. Click to resend confirmation email.', ['controller' => 'emails', 'action' => 'index', '?'=>['email'=>$emailaddress, 'uuid'=>$uuidparam]]);
                    echo '</li>';
                }

                echo '<li>';
                echo $this->Html->link($user . ' logout', ['controller' => 'Users', 'action' => 'logout']);
                echo '</li>';
            } else {
                echo '<li>';
                echo $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']);
                echo '</li>';

                 echo '<li>';
                 echo $this->Html->link('Register', ['controller' => 'Users', 'action' => 'add']);
                 echo '</li>';
            }
            ?>
            <li>
                <?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['escape' => false]) ?>
            </li>
            <li>
                <?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['escape' => false]) ?>
            </li>

            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
