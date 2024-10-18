ALTER TABLE students
ADD CONSTRAINT unique_email UNIQUE (email);
--*************************************************
DELIMITER $$

CREATE PROCEDURE EnrollStudentInCourse(
    IN p_student_id INT,
    IN p_course_id INT
)
BEGIN
    DECLARE current_enrollment INT;
    DECLARE course_capacity INT;

    START TRANSACTION;
    
    SELECT COUNT(*) INTO current_enrollment
    FROM enrollments
    WHERE course_id = p_course_id;

    SELECT capacity INTO course_capacity
    FROM courses
    WHERE course_id = p_course_id;

    IF current_enrollment < course_capacity THEN
        IF NOT EXISTS (
            SELECT 1
            FROM enrollments
            WHERE student_id = p_student_id AND course_id = p_course_id
        ) THEN
            INSERT INTO enrollments (student_id, course_id, grade)
            VALUES (p_student_id, p_course_id, NULL);

            COMMIT;
        ELSE
            ROLLBACK;
           
        END IF;
    ELSE
        ROLLBACK;
    END IF;

END $$

DELIMITER ;