<?php

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_school':
                $schoolData = [
                    'id' => uniqid(),
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                if (School::createSchool($schoolData)) {
                    $_SESSION['message'] = 'School created successfully!';
                } else {
                    $_SESSION['error'] = 'Failed to create school.';
                }
                break;
                
            case 'enroll_teacher':
                $teacherData = [
                    'id' => uniqid(),
                    'name' => $_POST['name'],
                    'subject' => $_POST['subject'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                if (School::enrollTeacher($_POST['school_id'], $teacherData)) {
                    $_SESSION['message'] = 'Teacher enrolled successfully!';
                } else {
                    $_SESSION['error'] = 'Failed to enroll teacher. School not found.';
                }
                break;
                
            case 'save_student':
                $studentData = [
                    'id' => uniqid(),
                    'name' => $_POST['name'],
                    'age' => $_POST['age'],
                    'grade' => $_POST['grade'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                if (Student::saveInfo($_POST['teacher_id'], $studentData)) {
                    $_SESSION['message'] = 'Student information saved successfully!';
                } else {
                    $_SESSION['error'] = 'Failed to save student information. Teacher not found.';
                }
                break;
        }
        header('Location: '.$_SERVER['PHP_SELF']);
        exit();
    }
}


?>