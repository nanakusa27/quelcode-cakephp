<h2><?= $username ?>の評価</h2>
<table class="vertical-table">
	<tr>
		<th scope="row">評価</th>
		<td><?= $rating_avg ?></td>
    </tr>
    <?php if (is_null($rating_comments)): ?>
        <tr>
            <th scope="row">コメント</th>
            <td>まだコメントがありません。</td>
        </tr>
    <?php else: ?>
        <?php foreach($rating_comments as $comment): ?>
            <tr>
                <th scope="row"></th>
                <td><?= h($comment->comment) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
