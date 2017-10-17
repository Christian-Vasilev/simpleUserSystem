<?php
session_start();
include_once '../views/Login.html';
if(!isset($_SESSION['user_id'])) {
    if ($_POST['login']) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        try {

            $db = new PDO('mysql:host=localhost;dbname=login', 'root', '');
            $db_stm = $db->prepare('SELECT ID,USERNAME, PASSWORD FROM users WHERE USERNAME = ?');
            $db_stm->execute(Array($username));

            while ($getData = $db_stm->fetch(PDO::FETCH_ASSOC)) {


                if ($username === $getData['USERNAME'] AND $password === $getData['PASSWORD']) {

                    $_SESSION['user_id'] = $getData['ID'];
                    $_SESSION['username'] = $getData['USERNAME'];
                    header("refresh:3;url=../index.php");
                    echo 'Welcome, ' . $_SESSION['username'] . "<br/>" . 'You will be redirected in 3 seconds.' . "<br/>";
                    echo 'If the redirection does not work please click the link bellow' . "<br/>";
                    echo "<a href='../index.php'>LINK</a>";
                } else {
                    echo 'Password or username does not match';
                }
            }

        } catch (PDOException $exception) {

            throw new Exception($exception->getMessage(), $exception->getCode());

        }

    }
}else{
    echo 'You are already logged in';
}

