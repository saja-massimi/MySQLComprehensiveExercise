<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    require 'dbconn.php';

    $query1 = "SELECT *, COUNT(e.student_id) AS NumberOfStudents
    FROM Courses c
    LEFT JOIN Enrollments e ON c.course_id = e.course_id
    GROUP BY c.course_name;";

    $stmt1 = $conn->prepare($query1);
    $stmt1->execute();
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $courses = $stmt1->fetchAll();

    $query2 = "SELECT * FROM students 
JOIN enrollments ON students.student_id = enrollments.student_id 
WHERE  enrollments.grade = 'A'";

    $stmt2 = $conn->prepare($query2);
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    $students = $stmt2->fetchAll();

    $query3 = "SELECT c.course_name, 
    i.instructor_fname  , i.instructors_lname,
    ca.semester
    FROM courses c
    JOIN course_assignment ca ON c.course_id = ca.course_id
    JOIN instructors i ON ca.instructor_id = i.instructor_id
    WHERE ca.semester ='Spring';
    ";



    $stmt3 = $conn->prepare($query3);
    $stmt3->execute();
    $stmt3->setFetchMode(PDO::FETCH_ASSOC);
    $course_instructor = $stmt3->fetchAll();


    $query4 = 
    "SELECT c.course_name, AVG(e.grade) AS AverageGrade
    FROM Courses c
    JOIN enrollments e ON c.course_id = e.course_id
    WHERE c.course_name = '	OOP'  
    GROUP BY course_name;";

    $stmt4 = $conn->prepare($query4);
    $stmt4->execute();
    $stmt4->setFetchMode(PDO::FETCH_ASSOC);
    $average_grade = $stmt4->fetchAll();

    ?>


    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Credits</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Department</th>
                    <th scope="col">Num of Student Enrolled</th>

                </tr>
            </thead>

            <tbody>
                <?php

                foreach ($courses as $course) {
                    echo "<tr>";
                    echo "<td>" . $course['course_id'] . "</td>";
                    echo "<td>" . $course['course_name'] . "</td>";
                    echo "<td>" . $course['course_code'] . "</td>";
                    echo "<td>" . $course['credits'] . "</td>";
                    echo "<td>" . $course['department'] . "</td>";
                    echo "<td>" . $course['NumberOfStudents'] . "</td>";
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Major</th>
                    <th scope="col">Enrollment Year</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($students as $student) {
                    echo "<tr>";
                    echo "<td>" . $student['student_id'] . "</td>";
                    echo "<td>" . $student['first_name'] . "</td>";
                    echo "<td>" . $student['last_name'] . "</td>";
                    echo "<td>" . $student['email'] . "</td>";
                    echo "<td>" . $student['date_of_birth'] . "</td>";
                    echo "<td>" . $student['gender'] . "</td>";
                    echo "<td>" . $student['major'] . "</td>";
                    echo "<td>" . $student['enrollment_year'] . "</td>";
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Instructor Name</th>
                    <th scope="col">Semester</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($course_instructor as $inst) {
                    echo "<tr>";
                    echo "<td>" . $inst['course_name'] . "</td>";
                    echo "<td>" . $inst['instructor_fname'] . " " . $inst['instructors_lname'] . "</td>";
                    echo "<td>" . $inst['semester'] . "</td>";
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>