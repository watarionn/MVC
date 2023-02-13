<?php
require_once(ROOT_PATH.'/Models/Db.php');
class Country extends Db{
    private $table = 'countries';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    public function findAll(){
        $sql = 'SELECT * FROM ' . $this->table;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function clubAll(){
        $sql = 'SELECT club FROM players';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>