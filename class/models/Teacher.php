<?php
class Teacher {
    public static function enrollInformation($studentData) {
        // Load existing students
        $students = unserialize(file_get_contents('students.txt')) ?: [];
        
        // Add new student
        $students[] = $studentData;
        
        // Save back to file
        file_put_contents('students.txt', serialize($students));
        
        return true;
    }
    
    public static function viewAllStudents() {
        $students = unserialize(file_get_contents('students.txt')) ?: [];
        return $students;
    }
    
    public static function getTeacher($teacherId) {
        $teachers = unserialize(file_get_contents('teachers.txt')) ?: [];
        foreach ($teachers as $teacher) {
            if ($teacher['id'] == $teacherId) {
                return $teacher;
            }
        }
        return null;
    }
}
?>