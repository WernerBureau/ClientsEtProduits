<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customerOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customer Orders'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customerOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($customerOrder) ?>
    <fieldset>
        <legend><?= __('Add Customer Order') ?></legend>
        <?php
            echo $this->Form->control('customer_id');
            echo $this->Form->control('order_date');
            echo $this->Form->control('products._ids', [
                    'options' => $products,
                    'id' => 'magicselect',
                    'type' => 'select',
                    'multiple' => 'list'
            ]);
            echo $this->Form->control('order_items.quantity');
            echo $this->Form->control('order_items.price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
