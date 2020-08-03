<h2>レビューする</h2>
<?= $this->Form->create($rating) ?>
<fieldset>
	<legend>評価１〜５とコメントを入力：</legend>
	<?php
        echo $this->Form->label('評価を選択してください');
        echo '<br>';
        $options = [
            'value5' => 5,
            'value4' => 4,
            'value3' => 3,
            'value2' => 2,
            'value1' => 1,
        ];
        echo $this->Form->radio('radio', $options);

		echo "コメント";
		echo $this->Form->textarea('comment');
	?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

