<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customer Orders'), ['controller' => 'CustomerOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer Order'), ['controller' => 'CustomerOrders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customers form large-10 medium-9 columns content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
            echo $this->Form->control('number', ['disabled' => 'disabled']);
            echo $this->Form->control('name');
            echo $this->Form->control('phone');
            echo $this->Form->control('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
