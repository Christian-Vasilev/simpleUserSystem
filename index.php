<?php
session_start();
?>
<html>
<head>
    <title>FIrst login system</title>
    <link rel="stylesheet" href="styles/style.css"/>

</head>
<body>
<?php if(isset($_SESSION['user_id']) == TRUE): ?>
    <img src="images/Logo.png"/><br/>
    You are logged in as, <?= $_SESSION['username'] ?><br/><br/>
   <a href="views/change_password.html" class="links">Change password</a> | <a href="controllers/logout.php" class="links">Logout</a>

<?php else: ?>
<table style="text-align:center;">
    <tr>
        <td>
            <div class="box">
                <h1>Login</h1>

                <form action="controllers/login.php" method="post">
                    <p>Username:</p>
                    <input type="text"  name="username" class="login"/>
                    <p>Password:</p>
                    <input type="password"  name="password" class="login"/><br/><br/>

                    <input type="submit" value="Login" name="login" class="login"/>


                </form>
                <Br/>
            </div>
        </td>
        <td>
            <div class="box">
                <h1>Register</h1>

                <form action="controllers/register.php" method="post">
                    <p>Username:</p>
                    <input type="text"  name="username" class="login"/>

                    <p>Password:</p>
                    <input type="password"  name="password" class="login"/>

                    <p>Age:</p>
                    <select name="age" class="login">

                        <?php for($i=18;$i<65; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <br/><br/>

                    <input type="submit" value="Register" name="register" class="login"/>

                </form>
                <Br/>
            </div>
        </td>
    </tr>
</table>
<?php endif; ?>

</body>
</html>


