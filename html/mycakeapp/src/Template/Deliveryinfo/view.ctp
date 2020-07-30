<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deliveryinfo $deliveryinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Deliveryinfo'), ['action' => 'edit', $deliveryinfo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Deliveryinfo'), ['action' => 'delete', $deliveryinfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliveryinfo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Deliveryinfo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Deliveryinfo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="deliveryinfo view large-9 medium-8 columns content">
    <h3><?= h($deliveryinfo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Destination') ?></th>
            <td><?= h($deliveryinfo->destination) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver Name') ?></th>
            <td><?= h($deliveryinfo->receiver_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver Tel') ?></th>
            <td><?= h($deliveryinfo->receiver_tel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($deliveryinfo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bidinfo Id') ?></th>
            <td><?= $this->Number->format($deliveryinfo->bidinfo_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($deliveryinfo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($deliveryinfo->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Sent') ?></th>
            <td><?= $deliveryinfo->is_sent ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Received') ?></th>
            <td><?= $deliveryinfo->is_received ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Ratings') ?></h4>
        <?php if (!empty($deliveryinfo->ratings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Target User Id') ?></th>
                <th scope="col"><?= __('Reviewer User Id') ?></th>
                <th scope="col"><?= __('Deliveryinfo Id') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($deliveryinfo->ratings as $ratings): ?>
            <tr>
                <td><?= h($ratings->id) ?></td>
                <td><?= h($ratings->target_user_id) ?></td>
                <td><?= h($ratings->reviewer_user_id) ?></td>
                <td><?= h($ratings->deliveryinfo_id) ?></td>
                <td><?= h($ratings->rating) ?></td>
                <td><?= h($ratings->comment) ?></td>
                <td><?= h($ratings->created) ?></td>
                <td><?= h($ratings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ratings', 'action' => 'view', $ratings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ratings', 'action' => 'edit', $ratings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ratings', 'action' => 'delete', $ratings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
