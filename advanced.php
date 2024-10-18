<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced</title>
</head>

<body>
    <?php
    require 'dbconn.php';
    $query1 = "SELECT s.first_name, s.last_name , COUNT(e.course_id) AS NumberOfCourses
        FROM students s
        JOIN enrollments e ON s.student_id = e.student_id
        JOIN course_assignment ca ON e.course_id = ca.course_id
        WHERE ca.semester = 'Spring' 
        HAVING COUNT(e.course_id) > 3;
    ";

    $stmt1 = $conn->prepare($query1);
    $stmt1->execute();
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $students = $stmt1->fetchAll();


    $query2 = "SELECT s.student_id, s.first_name, s.email
    FROM students s
    JOIN enrollments e ON s.student_id = e.student_id
    WHERE e.grade IS NULL
    ORDER BY s.student_id;";

    $stmt2 = $conn->prepare($query2);
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    $students2 = $stmt2->fetchAll();

    $query3 = "SELECT s.student_id, s.first_name, s.email, AVG(e.grade) AS avg_grade
    FROM students s
    JOIN enrollments e ON s.student_id = e.student_id
    GROUP BY s.student_id
    ORDER BY avg_grade DESC
    LIMIT 1";

    $stmt3 = $conn->prepare($query3);
    $stmt3->execute();
    $stmt3->setFetchMode(PDO::FETCH_ASSOC);
    $students3 = $stmt3->fetchAll();

    $query4 = "SELECT c.department, COUNT(*) AS course_count
    FROM courses c
    JOIN course_assignment ca ON c.course_id = ca.course_id
    WHERE YEAR(ca.year) = YEAR(CURDATE())
    GROUP BY c.department
    LIMIT 1;";

    $stmt4 = $conn->prepare($query4);
    $stmt4->execute();
    $stmt4->setFetchMode(PDO::FETCH_ASSOC);
    $students4 = $stmt4->fetchAll();

    $query5 = "SELECT c.course_id, c.course_name
    FROM courses c
    LEFT JOIN enrollments e ON c.course_id = e.course_id
    WHERE e.student_id IS NULL;";
    $stmt5 = $conn->prepare($query5);
    $stmt5->execute();
    $stmt5->setFetchMode(PDO::FETCH_ASSOC);
    $students5 = $stmt5->fetchAll();


    ?>



</body>

</html>