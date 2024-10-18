SELECT s.student_id, s.first_name, s.last_name, c.course_name
FROM students s
INNER JOIN enrollments e ON s.student_id = e.student_id
INNER JOIN courses c ON e.course_id = c.course_id;

--*************************************************

SELECT i.instructor_id, i.first_name, i.last_name, c.course_name
FROM instructors i
LEFT JOIN courses c ON i.instructor_id = c.instructor_id;

--*************************************************

SELECT s.student_id AS id, s.first_name, s.last_name, 
FROM students s
UNION
SELECT i.instructor_id AS id, i.first_name, i.last_name, 
FROM instructors i;