<?php

include 'connection.php';

if($_POST){

    //data
    $username = $_POST['username']??'';
    $password = $_POST['password']??'';

    $response = []; //respon data

    //cek username dalam db
    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));
    $query = $userQuery->fetch();

    if($userQuery->rowCount()==0){
        $response['status'] = false;
        $response['message'] = "username tidak terdaftar";
    }else{

        $passwordDB = $query['password'];

        if(strcmp(md5($password),$passwordDB) !== 0){
            $response['status'] =true;
            $response['message'] ='login berhasil';
            $response['data'] =[
                'user_id' => $query['id'],
                'username' => $query['username'],
                //'email' => $query['email']
            ];
        }else{
            $response['status'] = false;
            $response['message'] = 'password salah';
        }

     }

}

    $json = json_encode($response, JSON_PRETTY_PRINT);
    echo $json;


?>