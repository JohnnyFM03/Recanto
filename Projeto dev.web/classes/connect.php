<?php

class Database{

   private $host  = "localhost";
   private $user =  "root" ;
   private $senha = ""; 
   private $db = "recanto_db";

    function connect(){

    $connection = mysqli_connect($this->host,$this->user,$this->senha,$this->db);
    return $connection;

    }

    function read($query){

        $conn = $this->connect();
        $result = mysqli_query($conn,$query);

        if(!$result){
            return false;
        }else{
            $data = false;
            while($row = mysqli_fetch_assoc($result)){

             $data[] = $row;
             
            }
            
            return $data;
        }
    }

    function save($query){

        $conn = $this->connect();
        $result = mysqli_query($conn,$query);

        if(!$result){
            return false;
        }else{
            return true;
        }

    }

}