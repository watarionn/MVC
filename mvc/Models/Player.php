<?php
require_once(ROOT_PATH.'/Models/Db.php');
class Player extends Db{
    const PLAYER_LIMIT = 20;
    private $table = 'players';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    public function findAll($page = 0){
        $sql = 'SELECT p.id, uniform_num, position, p.name, c.name AS country, club, birth, height, weight FROM ' . $this->table . ' p LEFT JOIN countries c ON c.id = p.country_id WHERE del_flg = 0';
        $sql .= ' LIMIT '.(20 * $page).','.self::PLAYER_LIMIT;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function findById($id) {
        $sql = 'SELECT p.id, uniform_num, position, p.name, c.name AS country, club, birth, height, weight FROM ' . $this->table . ' p LEFT JOIN countries c ON c.id = p.country_id WHERE p.id = '.$id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function goalsById($id) {
        $sql = 'SELECT pairings.kickoff, (SELECT countries.name FROM countries WHERE pairings.enemy_country_id = countries.id) AS enemy, goal_time FROM goals JOIN pairings ON goals.pairing_id = pairings.id WHERE goals.player_id = ' . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_table(){
        $sql = 'DELETE FROM players_tmp';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function insert_tmp(){
        $sql = 'INSERT INTO players_tmp SELECT c.name, uniform_num, position, p.name, club, birth, height, weight FROM players p JOIN countries c ON c.id = p.country_id';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Undocumented function
     *
     * @param [int] $id
     * @return void
     */
    public function deleteById($id) {
        $sql = 'UPDATE players SET del_flg = 1 WHERE players.id = ' . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateById($id,$uniform_num,$position,$name,$country,$club,$birth,$height,$weight){
        $sql = 'UPDATE players SET uniform_num = ' . $uniform_num . ', position = "' . $position . '", name = "' . $name . '", country_id = ' . $country . ', club = "' . $club . '", birth = "' . $birth . '", height = ' . $height . ', weight = ' . $weight . ' WHERE players.id = ' . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function countAll(){
        $sql = 'SELECT count(*) as count FROM '.$this->table;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $count = $sth->fetchColumn();
        return $count;
    }
}
?>