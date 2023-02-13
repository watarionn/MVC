<?php
require_once(ROOT_PATH .'Controllers/PlayerControllers.php');
$player = new PlayerController();
$delete = $player->deleteId();
$params = $player->index();
$url = $player->url_GET_delete();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オブジェクト指向 - 選手一覧</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="../js/script3.js"></script>
</head>
<body>
<h2>選手一覧</h2>
<table accept-charset="UTF-8">
    <tr>
        <th>No</th>
        <th>背番号</th>
        <th>ポジション</th>
        <th>名前</th>
        <th>国籍</th>
        <th>所属</th>
        <th>誕生日</th>
        <th>身長</th>
        <th>体重</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($params['players'] as $player): ?>
        <tr>
            <td><?=$player['id'] ?></td>
            <td><?=$player['uniform_num'] ?></td>
            <td><?=$player['position'] ?></td>
            <td><?=$player['name'] ?></td>
            <td><?=$player['country'] ?></td>
            <td><?=$player['club'] ?></td>
            <td><?=$player['birth'] ?></td>
            <td><?=$player['height'] ?>cm</td>
            <td><?=$player['weight'] ?>kg</td>
            <td>
                <form action="../view.php" method="get">
                    <input type="hidden" name="id" value="<?= $player['id'] ?>">
                    <input type="submit" value="詳細">
                </form>
            </td>
            <td>
                <form action="../edit.php" method="get">
                    <input type="hidden" name="id" value="<?= $player['id'] ?>">
                    <input type="submit" value="編集">
                </form>
            </td>
            <td>
                <form action="index.php" method="get">
                    <input type="hidden" name="delete_id" value="<?= $player['id'] ?>">
                    <input type="submit" class="delete_id" value="削除" onclick="return confirm_delete()">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
</table>
<div class="paging">
    <?php
    for($i = 0; $i <= $params['pages']; $i++){
        if(isset($_GET['page']) && $_GET['page'] == $i){
            echo $i +1;
        } else {
            echo "<a href='?page=".$i."'> ".($i + 1)." </a>";
        }
    }

    ?>
</div>

    </body>
</html>