<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $productType
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $productType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Product Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="productTypes form large-10 medium-9 columns content">
    <?= $this->Form->create($productType) ?>
    <fieldset>
        <legend><?= __('Edit Product Type') ?></legend>
        <?php
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
