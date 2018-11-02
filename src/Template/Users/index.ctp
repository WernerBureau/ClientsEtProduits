<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<?php if ($this->request->getSession()->read('Auth.User.role') >= 1) { ?>
<div class="users index large-10 medium-9 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <? } ?>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>

            <?php if ($this->request->getSession()->read('Auth.User.id') === $user['id']) { ?>
                <tr>

                <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                        <td><?= $this->Number->format($user->id) ?></td>
                <? } ?>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>

                    <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                     <? } ?>
                </td>
                </tr>
            <? } else { ?>
            <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                <tr>

                    <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                        <td><?= $this->Number->format($user->id) ?></td>
                <? } ?>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>

                    <?php if ($this->request->getSession()->read('Auth.User.role') >= 3) { ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                     <? } ?>
                </td>
                </tr>
                <? }?>
                <? }?>
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
<?php } ?>