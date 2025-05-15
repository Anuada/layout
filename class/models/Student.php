<?php
class Student {
    public static function saveInfo($teacherId, $studentData) {
        // Validate teacher exists
        $teacher = Teacher::getTeacher($teacherId);
        if (!$teacher) return false;
        
        // Add teacher reference to student data
        $studentData['teacher_id'] = $teacherId;
        
        // Use Teacher's method to enroll
        return Teacher::enrollInformation($studentData);
    }
    
    public static function getStudent($studentId) {
        $students = unserialize(file_get_contents('students.txt')) ?: [];
        foreach ($students as $student) {
            if ($student['id'] == $studentId) {
                return $student;
            }
        }
        return null;
    }
}

?>