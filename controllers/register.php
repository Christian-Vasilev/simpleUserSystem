<?php


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    if(empty($username)){

        echo "Username can't be left blank.";

    }elseif(empty($password)){

        echo "Password can't be left blank.";

    }
    try{


        $db = new PDO('mysql:host=localhost;dbname=login', 'root', '');

        $db_stm = $db->prepare('INSERT INTO users (USERNAME,PASSWORD,AGE)
                                VALUES (:username,:password,:age)');


        $db_stm->bindParam('username', $username);
        $db_stm->bindParam('password', $password);
        $db_stm->bindParam('age', $age);

        $db_stm->execute();

        echo $db->lastInsertId();
    }
    catch(PDOException $exception){
        throw new Exception($exception->getMessage(),$exception->getCode());
    }


}