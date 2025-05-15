<?php
class School {
    public static function enrollTeacher($schoolId, $teacherData) {
        // Load existing schools and teachers
        $schools = unserialize(file_get_contents('schools.txt')) ?: [];
        $teachers = unserialize(file_get_contents('teachers.txt')) ?: [];
        
        // Find the school
        $schoolFound = false;
        foreach ($schools as &$school) {
            if ($school['id'] == $schoolId) {
                $schoolFound = true;
                break;
            }
        }
        
        if (!$schoolFound) return false;
        
        // Add school reference to teacher data
        $teacherData['school_id'] = $schoolId;
        
        // Add new teacher
        $teachers[] = $teacherData;
        
        // Save back to file
        file_put_contents('teachers.txt', serialize($teachers));
        
        return true;
    }
    
    public static function viewStudentInfo($studentId) {
        return Student::getStudent($studentId);
    }
    
    public static function createSchool($schoolData) {
        $schools = unserialize(file_get_contents('schools.txt')) ?: [];
        $schools[] = $schoolData;
        file_put_contents('schools.txt', serialize($schools));
        return true;
    }
    
    public static function getSchool($schoolId) {
        $schools = unserialize(file_get_contents('schools.txt')) ?: [];
        foreach ($schools as $school) {
            if ($school['id'] == $schoolId) {
                return $school;
            }
        }
        return null;
    }
}



?>