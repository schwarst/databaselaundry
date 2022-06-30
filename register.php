<?php

include 'connection.php';

if($_POST){

    //data
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // $no_hp = filter_input(INPUT_POST, 'no_hp', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $no_hp = filter_input(INPUT_POST, 'no_hp', FILTER_SANITIZE_STRING);

    $response = [];
    //cek username dalam db
    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));


    if($userQuery->rowCount() !=0){

        $response['status'] = true;
        $response['message'] = "akun sudah digunakan";
    }else {
        $insertAccount = 'INSERT INTO user (username, email, password, no_hp ) values (:username, :email, :password, :no_hp )';
        $statement = $connection->prepare($insertAccount);

        try{
            $statement->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => md5($password),
                ':no_hp' => ($no_hp)
            ]); 

            $response['status'] = true;
            $response['message'] = 'berhasil daftar';
            $response['data'] = [
                'username' => $username,
                'email' => $email,
                'no_hp' => $no_hp
            ];
        } catch (Exeption $e){
            die($e->getMessage());
        }
    }
    $json = json_encode($response, JSON_PRETTY_PRINT);

    echo $json;
}