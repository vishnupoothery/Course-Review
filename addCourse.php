<?php

session_start();

require 'database.php';

$message = '';

if(!empty($_POST['dept']) && !empty($_POST['ccode'])):

// Enter the new user in the database
$sql = "INSERT INTO courses (dept,code,name) VALUES (:dept,:ccode,:cname)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':dept', $_POST['dept']);
$stmt->bindParam(':ccode', $_POST['ccode']);
$stmt->bindParam(':cname', $_POST['cname']);

if( $stmt->execute() ):
$message = 'Successfully Added';
else:
$message = 'Sorry there must have been an issue adding course';
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
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center">Add Course</a>
            </div>
        </nav>

        <div class="container">
            <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
            <?php endif; ?>
            <form action="addCourse.php" method="POST">
                <div class="hide-on-small-only"><br><br><br><br></div>
                <input type="text" placeholder="Enter Department" name="dept">
                <input type="text" placeholder="Enter Course code" name="ccode">
                <input type="text" placeholder="Enter Couse Title" name="cname">
                <input class="btn" type="submit" value="Submit">
            </form>
        </div>

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>