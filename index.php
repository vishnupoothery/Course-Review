<?php

session_start();

require 'database.php';

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
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">AAC NITC</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Give Feedback</a></li>
                    <li><a href="#">Contact US</a></li>
                    <li><a href="#">About</a></li>
                    <?php if(empty($user)): ?>
                    <li><a href="login.php">Login</a></li>
                    <?php else: ?>
                    <li><a href="addCourse.php">Add Review</a></li>
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
                    <li><a href="addCourse.php">Add Review</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <div class="section no-pad-bot" id="index-banner">
            <div class="container">

                <h3 class="center-align hide-on-small-only">Course Review NITC</h3>
                <h5 class="center-align hide-on-med-and-up">Course Review NITC</h5>
<!--
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Dept Name</h4></li>
                    <li class="collection-item hoverable">code - Course name</li>
                    <li class="collection-item">code - Course name</li>
                    <li class="collection-item">code - Course name</li>
                    <li class="collection-item">code - Course name</li>
                </ul>
                -->

                <ul class="collection with-header">
                    <li class="collection-header"><h4>Dept Name</h4></li>
                    <?php 

                    foreach($conn->query('SELECT code,name FROM courses') as $row){
                        echo '<li class="collection-item hoverable">'.$row['code'].' - '.$row['name'].'</li>';
                    }

                    ?>
                </ul>
            </div>
        </div>


        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>