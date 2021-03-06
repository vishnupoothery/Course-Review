<?php

session_start();    

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])):

// Enter the new user in the database
$sql = "INSERT INTO users (name,username,mobile,email, password,access) VALUES (:name,:username,:mobile,:email, :password,:access)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':username', $_POST['username']);
$stmt->bindParam(':mobile', $_POST['mobile']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':access', $_POST['access']);
$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

if( $stmt->execute() ):
$message = 'Successfully created new user';
else:
$message = 'Sorry there must have been an issue creating your account';
endif;

endif;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>NITC Course Review</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center">Add User</a>
            </div>
        </nav>
        <?php if(!($_SESSION['access']=='1')): ?>
        <h1>You don't have permission to add new user</h1>
        <?php else: ?>
        <div class="container">
            <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
            <?php endif; ?>
            <form action="register.php" method="POST">
                <div class="hide-on-small-only"><br><br><br><br></div>
                <input type="text" placeholder="Enter your name" name="name">
                <input type="text" placeholder="Enter your username" name="username">
                <input type="text" placeholder="Enter your number" name="mobile">
                <input type="text" placeholder="Enter your email" name="email">
                <input type="password" placeholder="and password" name="password">
                <input type="password" placeholder="confirm password" name="confirm_password">
                <p>User Type</p>
                <p>
                    <input value="1" id="r1" name="access" type="radio" /><label for="r1">
                    <span>Admin</span>
                    </label>
                </p>
                <p>
                    <input value="0" id="r2" name="access" type="radio" /><label for="r2">
                    <span>Content Creator</span>
                    </label>
                </p>
                <input class="btn" type="submit" value="Login">
            </form>



            <form action="#">


            </form>

        </div>
        <?php endif; ?>
        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>