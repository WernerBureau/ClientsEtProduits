<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customerOrder
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customer Orders'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customerOrders form large-10 medium-9 columns content">
    <?= $this->Form->create($customerOrder) ?>
    <fieldset>
        <legend><?= __('Add Customer Order') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['required' => true]);
            echo $this->Form->control('products._ids', ['required' => true, 'type' => 'select']);
            echo $this->Form->control('order_items.quantity', ['default' => 1]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
