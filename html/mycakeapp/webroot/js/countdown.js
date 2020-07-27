// 期限の取得
var end = JSON.parse('<?php echo $end_json; ?>');
var endTime = new Date(end);

// 使用する変数の宣言
var currentTime, period,
    cDay, cHour, cMinute, cSecond,
    insert = "";

// カウントダウンの処理
function countdown() {

    // 現在から期日日までの差を取得
    currentTime = new Date();
    period = endTime.getTime() - currentTime.getTime();

    // 期限を過ぎていないとき
    if (period >= 0) {
        // 日付を取得
        cDay = Math.floor(period / (1000 * 60 * 60 * 24));
        period -= (cDay * (1000 * 60 * 60 * 24));

        // 時間を取得
        cHour = Math.floor(period / (1000 * 60 * 60));
        period -= (cHour * (1000 * 60 * 60));

        // 分を取得
        cMinute = Math.floor(period / (1000 * 60));
        period -= (cMinute * (1000 * 60));

        // 秒を取得
        cSecond = Math.floor(period / (1000));
        period -= (cSecond * (1000));

        // フレーム
        cFlame = Math.floor(period / (10));

        // 残りの日数の書き換え
        insert = "";
        insert += '<span class="d">' + cDay + '</span>' + "日";
        insert += '<span class="h">' + cHour + '</span>' + ":";
        insert += '<span class="m">' + cMinute + '</span>' + ":";
        insert += '<span class="s">' + cSecond + '</span>' + ":";
        insert += '<span class="f">' + cFlame + '</span>' + "";
        document.getElementById('countdown-unit') . innerHTML = insert;

        // カウントダウンの処理を再実行
        setInterval(countdown, 1000);

    } else {
        // 期限を過ぎたとき
        document.getElementById('countdown-unit') . innerHTML = 'Time Up';
    }

}

// 処理の実行
countdown();


