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
    try {

        $query1 = "SELECT * FROM students";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
        $students = $stmt1->fetchAll();

        $query2 = "SELECT COUNT(course_id) FROM courses";
        $stmt2 = $conn->prepare($query2);
        $stmt2->execute();
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        $courses = $stmt2->fetchAll();
        $courses = $courses[0]['COUNT(course_id)'];

        $query3 = "SELECT s.* 
           FROM students s 
           JOIN enrollments enr ON s.student_id = enr.student_id
           JOIN courses c ON enr.course_id = c.course_id
           WHERE c.course_name = 'Circuit'";

        $stmt3 = $conn->prepare($query3);
        $stmt3->execute();
        $stmt3->setFetchMode(PDO::FETCH_ASSOC);
        $students_enroll = $stmt3->fetchAll();

        $query4 = "SELECT instructor_email from instructors";
        $stmt4 = $conn->prepare($query4);
        $stmt4->execute();
        $stmt4->setFetchMode(PDO::FETCH_ASSOC);
        $instructor_email = $stmt4->fetchAll();
   
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
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
        <p>Total number of courses offered by the university= <?php echo $courses ?></p>
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

                foreach ($students_enroll as $enr) {
                    echo "<tr>";
                    echo "<td>" . $enr['student_id'] . "</td>";
                    echo "<td>" . $enr['first_name'] . "</td>";
                    echo "<td>" . $enr['last_name'] . "</td>";
                    echo "<td>" . $enr['email'] . "</td>";
                    echo "<td>" . $enr['date_of_birth'] . "</td>";
                    echo "<td>" . $enr['gender'] . "</td>";
                    echo "<td>" . $enr['major'] . "</td>";
                    echo "<td>" . $enr['enrollment_year'] . "</td>";
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>

<div class="container">
    <p>Emails of all instructors:</p>
    <ul>
        <?php
        foreach ($instructor_email as $email) {
            echo "<li>" . $email['instructor_email'] . "</li>";
        }
        ?>
    </ul>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>