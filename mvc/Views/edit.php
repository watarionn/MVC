
<link rel="stylesheet" type="text/css" href="/css/style.css">
<?php
require_once(ROOT_PATH . 'Controllers/PlayerControllers.php');
$edit = new PlayerController();
$edit_val_flg = $edit->edit_validate();
if($edit_val_flg){
    $update_tmp = $edit->update_tmp();
    header('location:view.php?id='.$edit_val_flg);
    exit();
}elseif($edit_val_flg = False){
    
}
?>
<h2>選手情報編集</h2>
<form action="" method="post">
    <table>
        <?php
        
        $player = new PlayerController();
        $params = $player->view();
        foreach ($params['player'] as $player) :
        ?>
            <tr>
                <th>No</th>
                <td><?= $player['id'] ?><input type="hidden" name="edit_id" value="<?= $player['id'] ?>"></td>
            </tr>
            <tr>
                <th>背番号</th>
                <td><input type="text" value=<?= $player['uniform_num'] ?> name="edit_uniform_num" required></td>
            </tr>
            <tr>
                <th>ポジション</th>
                <td><select name="edit_position" id="position" value=<?= $player['position'] ?>>
                        <option value="MF">
                            MF
                        </option>
                        <option value="GK">
                            GK
                        </option>
                        <option value="DF">
                            DF
                        </option>
                        <option value="FW">
                            FW
                        </option>
                    </select></td>
            </tr>
            <tr>
                <th>名前</th>
                <td><input type="text" value=<?= $player['name'] ?> name="edit_name" required></td>
            </tr>
            <tr>
                <th>国籍</th>
                <td><select name="edit_country" id="country">
                <?php 
                $country = new PlayerController();
                $countries = $country->country();
                foreach($countries['countries'] as $country){
                echo '<option value="'. $country['id']. '">'. $country['name']. '</option>';
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <th>所属</th>
                <td><select name="edit_club" id="club">
                <?php 
                $club = new PlayerController();
                $clubs = $club->club();
                foreach($clubs['clubs'] as $club){
                echo '<option value="'. $club['club']. '">'. $club['club']. '</option>';
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <th>誕生日</th>
                <td><input type="date" max="<?= date('Y-m-d') ?>" min="1950-01-01" value=<?= $player['birth'] ?> name="edit_birth" required></td>
            </tr>
            <tr>
                <th>身長</th>
                <td><input type="text" value=<?= $player['height'] ?> name="edit_height" required>cm</td>
            </tr>
            <tr>
                <th>体重</th>
                <td><input type="text" value=<?= $player['weight'] ?> name="edit_weight" required>kg</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="submit" value="送信" class="edit_complete" name="edit" onclick="return confirm_edit()">
</form>
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
    require_once(ROOT_PATH . 'Controllers/PlayerControllers.php');
    $goal = new PlayerController();
    $params = $goal->view_goals();
    $i = 0;
    foreach ($params['goal'] as $goal) :
        $i++;
    ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $goal['kickoff'] ?></td>
            <td><?= $goal['enemy'] ?></td>
            <td><?= $goal['goal_time'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p><a href="players/index.php">トップへ戻る</a></p>
<script src="../js/script3.js"></script>
    </body>
    </html>