<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */

echo $this->Html->css('dropzone');
echo $this->Html->script('dropzone', ['block' => 'scriptLibraries']);

$urlRedirectToIndex = $this->Url->build([
    "controller" => "Files",
    "action" => "index"
]);

echo $this->Html->scriptBlock('var urlRedirectToIndex = "' . $urlRedirectToIndex . '";', ['block' => true]);
echo $this->Html->script('RedirectToIndex', ['block' => 'scriptBottom']);
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="files index large-10 medium-9 columns content">
    <h3><?= __('Files') ?></h3>

    <div class="image_upload_div">
        <?php
        echo $this->Form->create('image',
            array('url'=>array('controller'=>'Files','action'=>'add'),
                'method'=>'post',
                'id'=>'my-awesome-dropzone',
                'class'=>'dropzone',
                'type'=>'file',
                'autocomplete'=>'off'));
            $this->Form->unlockField('file');
        ?>

        <?php    echo $this->Form->end();?>
    </div>


    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <?php } ?>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= __('Preview') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
            <tr>
                <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                    <td><?= $this->Number->format($file->id) ?></td>
                <?php } ?>
                <td><?= h($file->name) ?></td>
                <td>
                    <?php
                    echo $this->Html->image($file->path . $file->name, [
                        "alt" => $file->name,
                        "width" => "50px",
                        "height" => "50px",
                        'url' => ['action' => 'view', $file->id]
                    ]);
                    ?>
                </td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $file->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $file->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?>
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
