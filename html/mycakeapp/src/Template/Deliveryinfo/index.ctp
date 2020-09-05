<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deliveryinfo[]|\Cake\Collection\CollectionInterface $deliveryinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Deliveryinfo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="deliveryinfo index large-9 medium-8 columns content">
    <h3><?= __('Deliveryinfo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bidinfo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('destination') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_sent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_received') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deliveryinfo as $deliveryinfo): ?>
            <tr>
                <td><?= $this->Number->format($deliveryinfo->id) ?></td>
                <td><?= $this->Number->format($deliveryinfo->bidinfo_id) ?></td>
                <td><?= h($deliveryinfo->destination) ?></td>
                <td><?= h($deliveryinfo->receiver_name) ?></td>
                <td><?= h($deliveryinfo->receiver_tel) ?></td>
                <td><?= h($deliveryinfo->is_sent) ?></td>
                <td><?= h($deliveryinfo->is_received) ?></td>
                <td><?= h($deliveryinfo->created) ?></td>
                <td><?= h($deliveryinfo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $deliveryinfo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deliveryinfo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deliveryinfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliveryinfo->id)]) ?>
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
