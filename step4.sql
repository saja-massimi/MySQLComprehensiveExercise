DELIMITER $$

CREATE FUNCTION CalculateAge(dob DATE)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE age INT;
    SET age = YEAR(CURDATE()) - YEAR(dob);
    
    RETURN age;
END $$

DELIMITER ;
--***************************************************************************
DELIMITER $$

CREATE PROCEDURE EnrollStudent(IN p_student_id INT, IN p_course_id INT)
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM enrollments
        WHERE student_id = p_student_id AND course_id = p_course_id
    ) THEN
        INSERT INTO enrollments (student_id, course_id, grade)
        VALUES (p_student_id, p_course_id, NULL);
    ELSE
        SELECT 'Student is already enrolled in the course' AS result;
    END IF;
END $$

DELIMITER ;
--***************************************************************************
SELECT d.department_name, AVG(e.grade) AS avg_grade
FROM enrollments e
JOIN courses c ON e.course_id = c.course_id
JOIN departments d ON c.department_id = d.department_id

