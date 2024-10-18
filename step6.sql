CREATE INDEX idx_course_code ON courses(course_code);
--*************************************************
EXPLAIN
SELECT s.student_id, s.first_name, s.last_name
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
WHERE e.course_id = 101;