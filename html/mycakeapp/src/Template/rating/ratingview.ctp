<h2><?= h($username) ?>の評価</h2>
<table class="vertical-table">
	<tr>
        <th scope="row">評価</th>
        <?php if (empty($rating_avg->rating_avg)): ?>
            <td>まだ評価がありません。</td>
        <?php else: ?>
            <td class="rating"><?= h(round($rating_avg->rating_avg, 1)) ?></td>
        <?php endif; ?>
    </tr>
    <?php if (empty($comments)): ?>
        <tr>
            <th scope="row">コメント</th>
            <td>まだコメントがありません。</td>
        </tr>
    <?php else: ?>
        <?php foreach($comments as $comment): ?>
            <tr>
                <th scope="row"></th>
                <td><?= h($comment->comment) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
