<?php
use Composer\Package\Link;
?>
<h2>送り先情報</h2>
<!-- 送り先情報が未記入のときのみフォームを表示 -->
<?php if ($deliveryinfo == Null ): ?>
    <?= $this->Form->create($deliveryinfo) ?>
    <fieldset>
        <legend>送り先情報を入力</legend>
        <?php
            echo "受け取り人名前";
            echo $this->Form->text('receiver_name');
            echo "受け取り住所";
            echo $this->Form->textarea('destination');
            echo "受取人電話番号";
            echo $this->Form->text('receiver_tel');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<?php else: ?>
    <!-- 送り先情報が記入されていれば送り先情報を表示する -->
    <h2>「<?= $deliveryinfo->bidinfo->biditems->name?>」の送付先情報</h2>
    <table class="vertical-table">
        <tr>
            <th scope="row">受け取り人名前</th>
            <td><?= h($deliveryinfo->receiver_name) ?></td>
        </tr>
        <tr>
            <th scope="row">受け取り住所</th>
            <td><?= h($deliveryinfo->destination) ?></td>
        </tr>
        <tr>
            <th scope="row">受取人番号</th>
            <td><?= h($deliveryinfo->receiver_tel) ?></td>
        </tr>
    </table>
    <!-- まだ発送していないかつ、出品者の場合に発送ボタンを表示 -->
    <?php if ($deliveryinfo->is_sent == 0): ?>
        <?php $this->Form->submit('発送しました。', ['name' => 'is_sent', 'value' => 1]) ?>
    <?php else: ?>
        <p>発送しました。</p>
    <?php endif; ?>
    <!-- まだ受け取っていないかつ、落札者の場合に受取ボタンを表示 -->
    <?php if ($deliveryinfo->is_recived == 0): ?>
        <?php $this->From->submit('受け取りました。', ['name' => 'is_received', 'value' => 1]) ?>
    <?php else: ?>
        <p>受け取りました。</p>
        <?php if ($rating == null): ?>
            <?php $this->Html->link('レビューする', [
                'controller' => 'RatingController.php',
                'action' => 'add'
            ]);
        ?>
        <?php else: ?>
            <p>レビューありがとうございました。</p>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
