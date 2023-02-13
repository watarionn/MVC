<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

<h2>選手詳細</h2>
<table>
    <?php
    require_once(ROOT_PATH .'Controllers/PlayerControllers.php');
    $player= new PlayerController();
    $params= $player->view();
    foreach($params['player'] as $player): 
    ?>
    <tr><th>No</th><td><?=$player['id'] ?></td></tr>
    <tr><th>背番号</th><td><?=$player['uniform_num'] ?></td></tr>
    <tr><th>ポジション</th><td><?=$player['position'] ?></td></tr>
    <tr><th>名前</th><td><?=$player['name'] ?></td></tr>
    <tr><th>国籍</th><td><?=$player['country'] ?></td></tr>
    <tr><th>所属</th><td><?=$player['club'] ?></td></tr>
    <tr><th>誕生日</th><td><?=$player['birth'] ?></td></tr>
    <tr><th>身長</th><td><?=$player['height'] ?></td></tr>
    <tr><th>体重</th><td><?=$player['weight'] ?></td></tr>
    <?php endforeach; ?>
</table>
<h2>得点履歴</h2>
<table>
    <tr>
        <th>No</th>
        <th>試合日時</th>
        <th>対戦相手</th>
        <th>ゴールタイム</th>
        <th></th>
    </tr>
    <?php
    require_once(ROOT_PATH .'Controllers/PlayerControllers.php');
    $goal= new PlayerController();
    $params= $goal->view_goals();
    $i = 0;
    foreach($params['goal'] as $goal): 
    $i++;
    ?>
    <tr>
        <td><?= $i ?></td>
        <td><?=$goal['kickoff'] ?></td>
        <td><?=$goal['enemy'] ?></td>
        <td><?=$goal['goal_time'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><a href="players/index.php">トップへ戻る</a></p>

<!-- <div class="paging">
    <?php
    for($i = 0; $i <= $params['pages']; $i++){
        if(isset($_GET['page']) && $_GET['page'] == $i){
            echo $i + 1;
        } else {
            echo "<a href='?page=".$i."'>".($i + 1)."</a>";
        }
    }
    ?>
</div> -->

    </body>
    </html>