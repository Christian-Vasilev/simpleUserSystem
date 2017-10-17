<?php
session_start();

if(isset($_POST['change'])){

    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $repeatPassword = $_POST['repeat_password'];
    $currentUser = $_SESSION['username'];

    if(empty($currentPassword)){
        echo 'You must enter your current password'."<br/>";
    }elseif(empty($newPassword)){
        echo 'You must enter new password'."<br/>";
    }elseif(empty($repeatPassword)){
        echo 'You must repeat your new password'."<br/>";
    }

    try{
        $db = new PDO('mysql:host=localhost;dbname=login', 'root', '');
        $db_stm = $db->prepare('SELECT PASSWORD FROM users WHERE USERNAME = ?');

        $db_stm->execute(array($currentUser));

        while($row = $db_stm->fetch(PDO::FETCH_ASSOC)){

           if($row['PASSWORD'] != $currentPassword){

               echo 'The password you have entered does not match your current password.'."<br/>";

           }elseif($newPassword != $repeatPassword){

               echo 'The repeated password does not match your new password!'."<br/>";

           }elseif($newPassword === $repeatPassword AND $row['PASSWORD'] === $currentPassword){

               $dbUpdate = $db->prepare('UPDATE users SET PASSWORD = :new_password WHERE USERNAME = :current_user');
               $dbUpdate->bindParam('new_password', $newPassword);
               $dbUpdate->bindParam('current_user', $currentUser);

               $dbUpdate->execute();

               echo 'Your password has been updated successfully.'."<br/>";
               echo 'You will be logged out in 2 seconds to apply the new settings';
               header("refresh:3;url=logout.php");


           }


        }
    }catch (PDOException $exception) {

        throw new Exception($exception->getMessage(), $exception->getCode());

    }

}

require_once '../views/change_password.html';