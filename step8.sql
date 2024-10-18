
SELECT 
    s.first_name ,
    s.last_name ,
    s.email ,
    c.course_name ,
    i.first_name ,
    i.last_name ,
    e.grade ,
    c.credits ,
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
JOIN instructors i ON c.instructor_id = i.instructor_id
