<?php

session_start();

if( isset($_SESSION['user_id']) ){
    header("Location: index.php");
}

require 'database.php';

if(!empty($_POST['username']) && !empty($_POST['password'])):

$records = $conn->prepare('SELECT id,username,password FROM users WHERE username = :username');
$records->bindParam(':username', $_POST['username']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$message = '';

if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

    $_SESSION['user_id'] = $results['id'];
    header("Location: index.php");

} else {
    $message = 'Sorry, those credentials do not match';
}

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
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center">Login</a>
            </div>
        </nav>

        <div class="container">
            <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="hide-on-small-only"><br><br><br><br></div>
                <input type="text" placeholder="Enter your username" name="username">
                <input type="password" placeholder="and password" name="password">

                <input class="btn" type="submit" value="Login">
                <p>or <span><a href="register.php">register here</a></span></p>
            </form>
        </div>

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>
