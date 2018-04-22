<?php

session_start();    

if(!isset($_SESSION['user_id']) ){
    header("Location: login.php");
}

require 'database.php';

$message = '';

if( isset($_SESSION['user_id']) ){

    $records = $conn->prepare('SELECT id,name,username,mobile,email,password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if( count($results) > 0){
        $user = $results;
    }

}

if(!empty($_POST['oldpass']) && !empty($_POST['password'])):

// Enter the new user in the database
$records = $conn->prepare('SELECT password FROM users WHERE id = :id');
$records->bindParam(':id', $_SESSION['user_id']);

$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);
if(count($results) > 0 && password_verify($_POST['oldpass'], $results['password']) ){
    $sql = "UPDATE users SET password=:password WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
    if( $stmt->execute() ):
    $message = 'password Successfully changed';
    else:
    $message = 'Sorry there must have been an issue changing your password';
    endif;
}
else
    $message = 'Sorry there must have been an issue changing your password';

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
            <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">AAC NITC</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Give Feedback</a></li>
                    <li><a href="#">Contact US</a></li>
                    <li><a href="#">About</a></li>
                    <?php if(empty($user)): ?>
                    <li><a href="login.php">Login</a></li>
                    <?php else: ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="#">Give Feedback</a></li>
                    <li><a href="#">Contact US</a></li>
                    <li><a href="#">About</a></li>
                    <?php if(empty($user)): ?>
                    <li><a href="login.php">Login</a></li>
                    <?php else: ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <div class="container">
            <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
            <?php endif; ?>
            <form action="changePassword.php" method="POST">
                <div><br><br><br><br></div>
                <input type="password" placeholder="Enter old password" name="oldpass">
                <input type="password" placeholder="Enter new password" name="password">
                <input class="btn" type="submit" value="Change Password">
            </form>



            <form action="#">


            </form>

        </div>
        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>