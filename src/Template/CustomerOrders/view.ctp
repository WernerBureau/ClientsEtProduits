<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customerOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer Order'), ['action' => 'edit', $customerOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer Order'), ['action' => 'delete', $customerOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer Order'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customerOrders view large-9 medium-8 columns content">
    <h3><?= h(' Order # '.$customerOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customerOrder->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Id') ?></th>
            <td><?= $this->Number->format($customerOrder->customer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order date') ?></th>
            <td><?= h($customerOrder->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($customerOrder->modified) ?></td>
        </tr>
    </table>

    <h4><?= h(' Order items ') ?></h4>
    <table>
        <tbody>
        <th scope="row"><?= __('Item name') ?></th>
        <th scope="row"><?= __('Current price on item') ?></th>
        <th scope="row"><?= __('Quantity') ?></th>
        <th scope="row"><?= __('Total for this item') ?></th>

        <?php foreach ($customerOrder->products as $product): ?>
            <tr>
                <td><?= h($product->name) ?></td>
                <td><?= $this->Number->format($product->price). ' $' ?></td>
                <td><?= $this->Number->format($product->_joinData->quantity) ?></td>
                <td><?= $this->Number->format($product->_joinData->total) . ' $' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
