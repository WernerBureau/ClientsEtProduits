<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?></li>
        <li><hr/></li>
        <li><?= $this->Html->link(__('List Customer Orders'), ['controller' => 'CustomerOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer Order'), ['controller' => 'CustomerOrders', 'action' => 'add']) ?></li>
        <li><hr/></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><hr/></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add Files'), ['controller' => 'Files', 'action' => 'add']) ?></li>
    </ul>
</nav>
    <div class="customers index large-9 medium-8 columns content">
        <h3><?= __('About') ?></h3>
        <h4><?= __('Infos') ?></h4>
        <ul>
            <li>
                <?= ('Werner Burat') ?>
            </li>
            <li>
                <?= ('420-5b7 MO Applications internet.') ?>
            </li>
            <li>
                <?= ('Automne 2018, Collège Montmorency.') ?>
            </li>
        </ul>
        <h4><?= __('How to use this website') ?></h4>
        <ul>
            <li>
                <?= __('Register for a new account using the Register button and validate your email to have
                normal access to the website') ?>
            </li>
            <li>
                <?= __('Create new product types, new products and new customers to be able to create "Customer orders"') ?>
            </li>
            <li>
                <?= __('You can add 1 item in an order but you can order multiple of the same one.') ?>
            </li>
            <li>
                <?= __('You can show the total price for an order by viewing the order.') ?>
            </li>
            <li>
                <?= __('If you want to add images to a product, you need to first add Files to the website 
                in the Files menu and then you can choose it when creating the product. You can associate multiple images to the same product.') ?>
            </li>
        </ul>
        <h4><?= __('Users') ?></h4>
            <?= __('There are 3 types of users:') ?>
            <ul>
                <li>
                    <?= __('User: when the account is created but email isn\'t validated.') ?>
                    <br />
                    <?= __('They can view the database records but they can\'t add, edit or delete anything.') ?>
                </li>
                <li>
                    <?= __('Super-user: when the user validates their account.') ?>
                    <br />
                    <?= __('They can add and edit new products, product types, files, customers and customer orders.') ?>
                    <br />
                    <?= __('superuser@admin.com  |  superuser') ?>
                </li>
                <li>
                    <?= __('Admin: role only available to system administrators.') ?>
                    <br />
                    <?= __('They have access to all the add, edit and delete functions. They can also see IDs from the database.') ?>
                    <br />
                    <?= __('This role is dedicated for debugging and administrating purposes.') ?>
                    <br />
                    <?= __('admin@admin.com  |  admin') ?>
                </li>
            </ul>

        <h4><?= __('Diagrams') ?></h4>
        <?php
        echo $this->Html->image('diagram.jpg', [
            "alt" => 'UML diagram',
            "width" => "650px",
            "height" => "650px"
        ]);
        ?>

        <hr />
        <?= __('Link to the original diagram: ') ?>
        <?= $this->Html->link('http://www.databaseanswers.org/data_models/customers_and_products/index.htm') ?>
        <hr />

        <br />
        <br />
        <br />
        <br />
        <br />
    </div>
