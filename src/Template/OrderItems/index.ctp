<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem[]|\Cake\Collection\CollectionInterface $orderItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customer Orders'), ['controller' => 'CustomerOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer Order'), ['controller' => 'CustomerOrders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderItems index large-9 medium-8 columns content">
    <h3><?= __('Order Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $orderItem): ?>
            <tr>
                <td><?= $this->Number->format($orderItem->id) ?></td>
                <td><?= $orderItem->has('customer_order') ? $this->Html->link($orderItem->customer_order->id, ['controller' => 'CustomerOrders', 'action' => 'view', $orderItem->customer_order->id]) : '' ?></td>
                <td><?= $orderItem->has('product') ? $this->Html->link($orderItem->product->name, ['controller' => 'Products', 'action' => 'view', $orderItem->product->id]) : '' ?></td>
                <td><?= $this->Number->format($orderItem->quantity) ?></td>
                <td><?= $this->Number->format($orderItem->total) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
