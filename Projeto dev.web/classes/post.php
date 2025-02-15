<?php

class Post{

    private $error = "";

    public function create_post($userid, $data){

        if(!empty($data['post'])){

            $post = addslashes($data['post']);
            $postid = $this->create_postid();

            $query = "insert into posts(postid,userid,post) values('$postid','$userid','$post')";

            $DB = new Database();
            $DB->save($query);

        }else{

            $this->error .= "Escreva algo para publicar o post<br>";

        }

        return $this->error;

    }


    public function get_posts($id){

        $query = " select * from  posts where userid = '$id' order by id desc limit 10 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result){

            return $result;
        }else{
            return false;
        }


    }

    public function get_posts_outros($id){

        $query = " select * from  posts where userid != '$id' order by id desc limit 10 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result){

            return $result;
        }else{
            return false;
        }


    }

    private function create_postid(){

        $length = rand(4,19);
        $number = "";

        for($i=0; $i < $length; $i++){
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}