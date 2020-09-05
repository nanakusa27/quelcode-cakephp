<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deliveryinfo $deliveryinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deliveryinfo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deliveryinfo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Deliveryinfo'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="deliveryinfo form large-9 medium-8 columns content">
    <?= $this->Form->create($deliveryinfo) ?>
    <fieldset>
        <legend><?= __('Edit Deliveryinfo') ?></legend>
        <?php
            echo $this->Form->control('bidinfo_id');
            echo $this->Form->control('destination');
            echo $this->Form->control('receiver_name');
            echo $this->Form->control('receiver_tel');
            echo $this->Form->control('is_sent');
            echo $this->Form->control('is_received');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
