<h2>レビュー</h2>
<?= $this->Form->create($rating) ?>
<fieldset>
	<legend>評価１〜５とコメントを入力：</legend>
	<?php
        echo $this->Form->label('評価を選択してください');
        echo '<br>';
        $options = [
            5 => 'とても良かった 5',
            4 => '良かった 4',
            3 => '普通 3',
            2 => '悪かった 2',
            1 => 'とても悪かった 1',
        ];
        echo $this->Form->radio('rating', $options, ['value' => 3]);

		echo "コメント";
        echo $this->Form->textarea('comment',['maxlength' => 1000, 'placeholder' => 'コメントも必ずご記入ください！']);

        echo $this->Form->hidden('target_user_id', ['value' => $target_user_id]);
        echo $this->Form->hidden('reviewer_user_id', ['value' => $authuser['id']]);
        echo $this->Form->hidden('deliveryinfo_id', ['value' => $deliveryinfo->id]);
	?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

