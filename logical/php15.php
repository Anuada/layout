<?php
session_start();

// Initialize storage files if they don't exist
if (!file_exists('students.txt')) file_put_contents('students.txt', '');
if (!file_exists('teachers.txt')) file_put_contents('teachers.txt', '');
if (!file_exists('schools.txt')) file_put_contents('schools.txt', '');

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

// Get all data for display
$schools = unserialize(file_get_contents('schools.txt')) ?: [];
$teachers = unserialize(file_get_contents('teachers.txt')) ?: [];
$students = unserialize(file_get_contents('students.txt')) ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            font-weight: bold;
            background-color: #007bff;
            color: white;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .nav-tabs {
            margin-bottom: 20px;
        }
        .message-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success message-alert alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger message-alert alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <h1 class="text-center mb-4">School Management System</h1>
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="schools-tab" data-bs-toggle="tab" data-bs-target="#schools" type="button" role="tab">Schools</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="teachers-tab" data-bs-toggle="tab" data-bs-target="#teachers" type="button" role="tab">Teachers</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab">Students</button>
            </li>
        </ul>
        
        <div class="tab-content" id="myTabContent">
            <!-- Schools Tab -->
            <div class="tab-pane fade show active" id="schools" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Create New School</div>
                            <div class="card-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="create_school">
                                    <div class="mb-3">
                                        <label for="school_name" class="form-label">School Name</label>
                                        <input type="text" class="form-control" id="school_name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="school_address" class="form-label">Address</label>
                                        <textarea class="form-control" id="school_address" name="address" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create School</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">All Schools</div>
                            <div class="card-body">
                                <?php if (empty($schools)): ?>
                                    <p>No schools found.</p>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($schools as $school): ?>
                                                    <tr>
                                                        <td><?= substr($school['id'], 0, 8) ?></td>
                                                        <td><?= htmlspecialchars($school['name']) ?></td>
                                                        <td><?= htmlspecialchars($school['address']) ?></td>
                                                        <td><?= $school['created_at'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Teachers Tab -->
            <div class="tab-pane fade" id="teachers" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Enroll New Teacher</div>
                            <div class="card-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="enroll_teacher">
                                    <div class="mb-3">
                                        <label for="teacher_school" class="form-label">School</label>
                                        <select class="form-select" id="teacher_school" name="school_id" required>
                                            <option value="">Select School</option>
                                            <?php foreach ($schools as $school): ?>
                                                <option value="<?= $school['id'] ?>"><?= htmlspecialchars($school['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="teacher_name" class="form-label">Teacher Name</label>
                                        <input type="text" class="form-control" id="teacher_name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="teacher_subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="teacher_subject" name="subject" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enroll Teacher</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">All Teachers</div>
                            <div class="card-body">
                                <?php if (empty($teachers)): ?>
                                    <p>No teachers found.</p>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Subject</th>
                                                    <th>School</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($teachers as $teacher): ?>
                                                    <tr>
                                                        <td><?= substr($teacher['id'], 0, 8) ?></td>
                                                        <td><?= htmlspecialchars($teacher['name']) ?></td>
                                                        <td><?= htmlspecialchars($teacher['subject']) ?></td>
                                                        <td>
                                                            <?php 
                                                                $school = School::getSchool($teacher['school_id']);
                                                                echo $school ? htmlspecialchars($school['name']) : 'Unknown';
                                                            ?>
                                                        </td>
                                                        <td><?= $teacher['created_at'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Students Tab -->
            <div class="tab-pane fade" id="students" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Save Student Information</div>
                            <div class="card-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="save_student">
                                    <div class="mb-3">
                                        <label for="student_teacher" class="form-label">Teacher</label>
                                        <select class="form-select" id="student_teacher" name="teacher_id" required>
                                            <option value="">Select Teacher</option>
                                            <?php foreach ($teachers as $teacher): ?>
                                                <option value="<?= $teacher['id'] ?>">
                                                    <?= htmlspecialchars($teacher['name']) ?> (<?= htmlspecialchars($teacher['subject']) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="student_name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" id="student_name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="student_age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="student_age" name="age" required min="5" max="25">
                                    </div>
                                    <div class="mb-3">
                                        <label for="student_grade" class="form-label">Grade</label>
                                        <input type="text" class="form-control" id="student_grade" name="grade" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Information</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">All Students</div>
                            <div class="card-body">
                                <?php if (empty($students)): ?>
                                    <p>No students found.</p>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Age</th>
                                                    <th>Grade</th>
                                                    <th>Teacher</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($students as $student): ?>
                                                    <tr>
                                                        <td><?= substr($student['id'], 0, 8) ?></td>
                                                        <td><?= htmlspecialchars($student['name']) ?></td>
                                                        <td><?= $student['age'] ?></td>
                                                        <td><?= htmlspecialchars($student['grade']) ?></td>
                                                        <td>
                                                            <?php 
                                                                $teacher = Teacher::getTeacher($student['teacher_id']);
                                                                echo $teacher ? htmlspecialchars($teacher['name']) : 'Unknown';
                                                            ?>
                                                        </td>
                                                        <td><?= $student['created_at'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Close alert after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>