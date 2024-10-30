<?php

class Usuario{

    public function get_data($id){


        $query = "select * from usuarios where userid = '$id' limit 1";
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            
            $row = $result[0];
            return $row;

        }else{
            return false;
        }
    }

    public function get_amigos($id){


        $query = "select * from usuarios where userid != '$id' limit 4";
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            
            return $result;

        }else{
            return false;
        }
    }


}