<?php
use Composer\Package\Link;
?>
<!-- 送り先情報が未記入のときのみフォームを表示 -->
<?php if (empty($deliveryinfo)): ?>
    <?php if ($authuser['id'] == $bidinfo->user_id): ?>
        <h2>送り先情報</h2>
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
                echo $this->Form->hidden('bidinfo_id', ['value' => $bidinfo->id]);
                echo $this->Form->hidden('is_sent', ['value' => 0]);
                echo $this->Form->hidden('is_received', ['value' => 0]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    <?php else: ?>
        <p>まだ送り先情報がありません。</p>
    <?php endif; ?>
<?php else: ?>
    <!-- 送り先情報が記入されていれば送り先情報を表示する -->
    <h2>「<?= $biditem->name?>」の送付先情報</h2>
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
    <!-- まだ発送していないかつ、出品者の場合に発送ボタンを表示 -->
    <?php if ($deliveryinfo->is_sent == 0): ?>
        <?php if ($authuser['id'] == $biditem->user_id): ?>
            <?php
                echo $this->Form->create($deliveryinfo, ['type' => 'post']);
                echo $this->Form->hidden('is_sent', ['value' => 1]);
                echo $this->Form->hidden('is_received', ['value' => 0]);
                echo $this->Form->button('発送しました。');
                echo $this->Form->end();
            ?>
        <?php else: ?>
            <tr>
                <th scope="row">発送しましたか？</th>
                <td>いいえ</td>
            </tr>
        <?php endif; ?>
    <?php else: ?>
        <tr>
            <th scope="row">発送しましたか？</th>
            <td class="red">はい、発送しました。</td>
        </tr>
        <!-- まだ受け取っていないかつ発送したかつ落札者の場合に受取ボタンを表示 -->
        <?php if ($deliveryinfo->is_received == 0): ?>
            <?php if ($authuser['id'] == $bidinfo->user_id): ?>
                <?php
                    echo $this->Form->create($deliveryinfo, ['type' => 'post']);
                    echo $this->Form->hidden('is_sent', ['value' => 1]);
                    echo $this->Form->hidden('is_received', ['value' => 1]);
                    echo $this->Form->button('受け取りました。');
                    echo $this->Form->end();
                ?>
            <?php else: ?>
                <tr>
                    <th scope="row">受け取りましたか？</th>
                    <td>いいえ</td>
                </tr>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <th scope="row">受け取りましたか？</th>
                <td class="red">はい、受け取りました。</td>
            </tr>
            <?php if (empty($rating)): ?>
                <h4>
                <?= $this->Html->link('レビューする', [
                    'controller' => 'Rating',
                    'action' => 'ratingadd',
                    'deliveryinfo_id' => $deliveryinfo->id
                    ]);?>
                </h4>
            <?php else: ?>
            <p>レビューありがとうございました。</p>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    </table>
<?php endif; ?>
