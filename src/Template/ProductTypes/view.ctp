<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $productType
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product Type'), ['action' => 'edit', $productType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product Type'), ['action' => 'delete', $productType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Product Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="productTypes view large-9 medium-8 columns content">
    <h3><?= h($productType->type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($productType->type) ?></td>
        </tr>
        <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($productType->id) ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($productType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($productType->modified) ?></td>
        </tr>
    </table>
</div>
