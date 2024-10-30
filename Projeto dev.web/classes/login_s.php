<?php

class Login{

    private $error = "";

    public function evaluate($data){

       
        $email = addslashes($data['email']);
        $senha = addslashes($data['senha']);
        
        $query = "select * from usuarios where email = '$email' limit 1";

        $DB = new Database();
       $result = $DB->read($query);

       if($result){

        $row = $result[0];

        if(password_verify( $senha,$row['senha'])){

            $_SESSION['recanto_userid'] = $row['userid'];

        }else{
            $this->error .= "Email ou senha incorretos<br>";
        }

       }else{

        $this->error .= "Email ou senha incorretos<br>";
       }

        return $this->error;
    
        
    }

    public function check_login($id){

        if(is_numeric($id)){

            $query = "select * from usuarios where userid = '$id' limit 1";

            $DB = new Database();
            $result = $DB->read($query);

            if($result){

            $usuario_data = $result[0];
            return $usuario_data;

            }else{

                header("Location: ../regis_login/login.html");
                die;
            }
        }
    }

}

