<?php

session_start();

require 'database.php';

$message = '';

if(!empty($_POST['code'])):

// Enter the new user in the database
$sql = "INSERT INTO review (dept,code,title,type,faculty,motivation,outcome,pre,rating,faculty_feedback,assg_diff,exam_diff,misc_feedback,diff,grading,evaluation,reference,misc,stu_id) VALUES (:dept,:code,:title,:type,:faculty,:motivation,:outcome,:pre,:rating,:faculty_feedback,:assg_diff,:exam_diff,:misc_feedback,:diff,:grading,:evaluation,:reference,:misc,:stu_id)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':dept', $_POST['dept']);
$stmt->bindParam(':code', $_POST['code']);
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':type', $_POST['type']);
$stmt->bindParam(':faculty', $_POST['faculty']);
$stmt->bindParam(':motivation', $_POST['motivation']);
$stmt->bindParam(':outcome', $_POST['outcome']);
$stmt->bindParam(':pre', $_POST['pre']);
$stmt->bindParam(':rating', $_POST['rating']);
$stmt->bindParam(':faculty_feedback', $_POST['faculty_feedback']);
$stmt->bindParam(':assg_diff', $_POST['assg_diff']);
$stmt->bindParam(':exam_diff', $_POST['exam_diff']);
$stmt->bindParam(':misc_feedback', $_POST['misc_feedback']);
$stmt->bindParam(':diff', $_POST['diff']);
$stmt->bindParam(':grading', $_POST['grading']);
$stmt->bindParam(':evaluation', $_POST['evaluation']);
$stmt->bindParam(':reference', $_POST['reference']);
$stmt->bindParam(':misc', $_POST['misc']);
$stmt->bindParam(':stu_id', $_SESSION['user_id']);

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
        <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Add Course</a>
        </nav>


        <div class="container jumbetron">
            <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
            <?php endif; ?>
            <form action="addCourse.php" method="POST">
                <div class="form-group">
                    <label>Course Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Enter Course code">
                </div>
                <div class="form-group">
                    <label>Course Name</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter Course name">
                </div>
                <div class="form-group">
                    <label>Course Type</label>
                    <select class="form-control" name="type">
                        <option value="0">core</option>
                        <option value="1">Local Elective</option>
                        <option value="2">Global Elective</option>>
                    </select>
                </div>
                <div class="form-group">
                    <label>Department offering courses</label>
                    <select class="form-control" name="dept">
                        <option value="0">Computer Science</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Faculty who took the course</label>
                    <input type="text" class="form-control" name="faculty" placeholder="Enter Faculty name">
                </div>
                <div class="form-group">
                    <label>Motivation to Take this course</label>
                    <textarea class="form-control" name="motivation"></textarea>
                </div>
                <div class="form-group">
                    <label>Course Outcomes</label>
                    <textarea class="form-control" name="outcome"></textarea>
                </div>
                <div class="form-group">
                    <label>Prerequisites</label>
                    <input type="text" class="form-control" name="pre" placeholder="Enter Prerequisites">
                </div>
                <div class="form-group">
                    <label>Rating on lectures</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="rating" value="1"><label class="form-check-label">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="rating" value="2"><label class="form-check-label">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="rating" value="3"><label class="form-check-label">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="rating" value="4"><label class="form-check-label">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="rating" value="5"><label class="form-check-label">5</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Feedback on lectures and faculty</label>
                    <textarea class="form-control" name="faculty_feedback"></textarea>
                </div>
                <div class="form-group">
                    <label>Tutorial/Assignment Difficulty</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="assg_diff" value="1"><label class="form-check-label">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="assg_diff" value="2"><label class="form-check-label">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="assg_diff" value="3"><label class="form-check-label">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="assg_diff" value="4"><label class="form-check-label">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="assg_diff" value="5"><label class="form-check-label">5</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Exam Difficulty</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="exam_diff" value="1"><label class="form-check-label">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="exam_diff" value="2"><label class="form-check-label">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="exam_diff" value="3"><label class="form-check-label">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="exam_diff" value="4"><label class="form-check-label">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="exam_diff" value="5"><label class="form-check-label">5</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Any other feedback or remarks on tutorials, assignments and exams?</label>
                    <textarea class="form-control" name="misc_feedback"></textarea>
                </div>
                <div class="form-group">
                    <label>Overall Difficulty</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="diff" value="1"><label class="form-check-label">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="diff" value="2"><label class="form-check-label">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="diff" value="3"><label class="form-check-label">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="diff" value="4"><label class="form-check-label">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="diff" value="5"><label class="form-check-label">5</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Grading System followed</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="grading" value="1"><label class="form-check-label">Absolute</label>
                    </div><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="grading" value="2"><label class="form-check-label">Relative</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>How is the evaluation?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="evaluation" value="1"><label class="form-check-label">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="evaluation" value="2"><label class="form-check-label">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="evaluation" value="3"><label class="form-check-label">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="evaluation" value="4"><label class="form-check-label">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" class="form-control" name="evaluation" value="5"><label class="form-check-label">5</label>
                    </div>
                </div>  
                <div class="form-group">
                    <label>Study Materials and References</label>
                    <textarea class="form-control" name="reference"></textarea>
                </div>
                <div class="form-group">
                    <label>Any other comments on the course?</label>
                    <textarea class="form-control" name="misc"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>                                

            </form>
        </div>

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>