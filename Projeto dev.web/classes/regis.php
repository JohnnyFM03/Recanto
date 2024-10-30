<?php

class Registrar{

    private $error ="";

    public function evaluate($data){

        foreach($data as $key => $value){
            if(empty($value)){
                $this->error.= $key . " está vazio!<br>";
            }

            if($key == "email"){

                if (!filter_var($value, FILTER_VALIDATE_EMAIL)){

                    $this->error = $this->error  . "Email invalido<br/>";
                }
            }

            if($key == "senha"){

                if(strlen($_POST["senha"]) < 8){
                    $this->error = $this->error . "A senha precisa ter no minimo 8 caracteres";
                }

                if( ! preg_match("/[a-z]/i", $_POST["senha"])){
                    $this->error = $this->error . "A senha precisa ter no minimo 1 letra";
                }

                if( ! preg_match("/[0-9]/i", $_POST["senha"])){
                    $this->error = $this->error . "A senha precisa ter no minimo 1 numero";
                }
               
                
            }

        }
            if($this->error == ""){

                $this->cria_usuario($data);
            }else{  

                return $this->error;
            }
    }

    public function cria_usuario($data){

        $usuario = $data['usuario'];
        $email = addslashes($data['email']);
        $senha = $data['senha'];
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $userid = $this->create_userid();
        $url_address = preg_replace('/[ _]+/' , '_' ,$usuario) . "." . strtolower($userid);
        

        $query = "insert into usuarios (userid,usuario,email,senha,url_address) values ('$userid','$usuario','$email','$senha_hash','$url_address')";

        $DB = new Database();
        $DB->save($query);
        
    }

    private function create_url(){

    }

    private function create_userid(){

        $length = rand(4,19);
        $number = "";

        for($i=0; $i < $length; $i++){
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }

        return $number;
    }


}