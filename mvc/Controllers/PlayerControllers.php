<?php
require_once(ROOT_PATH.'/Models/Player.php');
require_once(ROOT_PATH.'/Models/Country.php');

class PlayerController{
    private $Player;
    private $request;
    private $Country;
    // private $Goal;
    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
        $this->Player = new Player();
        $this->Country = new Country();
        // $dbh = $this->Player->get_db_handler();
        // $this->Goal = new Goal($dbh);
    }

    /**
     * 
     * @return array
     */
    public function index(){
        $page = 0;
        if(isset($this->request['get']['page'])){
            $page = $this->request['get']['page'];
        }
        $players = $this->Player->findAll($page);
        $players_count = $this->Player->countAll();
        $params = [
            'players' => $players,
            'pages' => $players_count / 20
        ];
        return $params;
    }

    public function country(){
        $countries = $this->Country->findAll();
        $params = [
            'countries' => $countries
        ];
        return $params;
    }

    public function club(){
        $clubs = $this->Country->clubAll();
        $params = [
            'clubs' => $clubs
        ];
        return $params;
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function view(){
        // if(empty($this->request['get']['id']) || !is_int($this->request['get']['id'])){
        //     echo "指定のパラメータが不正です。このページは表示できません";
        //     exit();
        // }
        $player = $this->Player->findById($this->request['get']['id']);
        $params = [
            'player' => $player
        ];
        return $params;
    }

    /**
     * goalsテーブルからゴール履歴を返す
     * @return array
     */
    public function view_goals(){
        // if(empty($this->request['get']['id']) || !is_int($this->request['get']['id'])){
        //     echo "指定のパラメータが不正です。このページは表示できません";
        //     exit();
        // }
        $goal = $this->Player->goalsById($this->request['get']['id']);
        $params = [
            'goal' => $goal
        ];
        return $params;
    }

    public function deleteId(){
        if(isset($this->request['get']['delete_id'])){
            $delete = $this->Player->deleteById($this->request['get']['delete_id']);
            return $delete;
        }
    }

    public function url_GET_delete(){
        $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if(strpos($url,'delete_id') !== false){ //'$url'のなかに'delete_id'が含まれている場合 
                $url = strtok($url, '?');
                header('location:' . $url);
                exit();
        }
    }

    public function edit_validate(){
        if(isset($this->request['post']['edit'])){
            
            function h($string){
                return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
            }
            $edit_id = $this->request['post']['edit_id'];
            $edit_uniform_num = $this->request['post']['edit_uniform_num'];
            $edit_position = $this->request['post']['edit_position'];
            $edit_name = h($this->request['post']['edit_name']);
            $edit_country = h($this->request['post']['edit_country']);
            $edit_club = h($this->request['post']['edit_club']);
            $edit_birth = $this->request['post']['edit_birth'];
            $edit_height = $this->request['post']['edit_height'];
            $edit_weight = $this->request['post']['edit_weight'];
            if(is_numeric($edit_uniform_num) && is_numeric($edit_height) && is_numeric($edit_weight)){
                $this->Player->updateById($edit_id,$edit_uniform_num,$edit_position,$edit_name,$edit_country,$edit_club,$edit_birth,$edit_height,$edit_weight);
                return $edit_id;
            }
        }
    }


    public function update_tmp(){
        $delete_table = $this->Player->delete_table();
        $insert_tmp = $this->Player->insert_tmp();

    }
}
?>