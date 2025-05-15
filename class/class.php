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
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-bottom: none;
            border-radius: 5px 5px 0 0;
            margin-right: 5px;
        }
        
        .tab.active {
            background-color: white;
            border-bottom: 1px solid white;
            margin-bottom: -1px;
            font-weight: bold;
            color: #3498db;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Cards */
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .card-header {
            background-color: #3498db;
            color: white;
            padding: 15px;
            font-weight: bold;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Forms */
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        /* Alerts */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px;
            border-radius: 4px;
            color: white;
            max-width: 400px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.5s;
        }
        
        .alert.show {
            opacity: 1;
        }
        
        .alert-success {
            background-color: #2ecc71;
        }
        
        .alert-danger {
            background-color: #e74c3c;
        }
        
        .close-btn {
            float: right;
            cursor: pointer;
            font-weight: bold;
        }
        
        /* Grid */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 10px;
        }
        
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success" id="successAlert">
                <span class="close-btn" onclick="this.parentElement.classList.remove('show')">&times;</span>
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" id="errorAlert">
                <span class="close-btn" onclick="this.parentElement.classList.remove('show')">&times;</span>
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <h1>School Management System</h1>
        
        <div class="tabs">
            <div class="tab active" onclick="openTab('schools')">Schools</div>
            <div class="tab" onclick="openTab('teachers')">Teachers</div>
            <div class="tab" onclick="openTab('students')">Students</div>
        </div>
        
        <div id="schools" class="tab-content active">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Create New School</div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="action" value="create_school">
                                <div class="form-group">
                                    <label for="school_name">School Name</label>
                                    <input type="text" id="school_name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="school_address">Address</label>
                                    <textarea id="school_address" name="address" required></textarea>
                                </div>
                                <button type="submit">Create School</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">All Schools</div>
                        <div class="card-body">
                            <?php if (empty($schools)): ?>
                                <div class="empty-state">No schools found.</div>
                            <?php else: ?>
                                <table>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="teachers" class="tab-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Enroll New Teacher</div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="action" value="enroll_teacher">
                                <div class="form-group">
                                    <label for="teacher_school">School</label>
                                    <select id="teacher_school" name="school_id" required>
                                        <option value="">Select School</option>
                                        <?php foreach ($schools as $school): ?>
                                            <option value="<?= $school['id'] ?>"><?= htmlspecialchars($school['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="teacher_name">Teacher Name</label>
                                    <input type="text" id="teacher_name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="teacher_subject">Subject</label>
                                    <input type="text" id="teacher_subject" name="subject" required>
                                </div>
                                <button type="submit">Enroll Teacher</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">All Teachers</div>
                        <div class="card-body">
                            <?php if (empty($teachers)): ?>
                                <div class="empty-state">No teachers found.</div>
                            <?php else: ?>
                                <table>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="students" class="tab-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Save Student Information</div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="action" value="save_student">
                                <div class="form-group">
                                    <label for="student_teacher">Teacher</label>
                                    <select id="student_teacher" name="teacher_id" required>
                                        <option value="">Select Teacher</option>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <option value="<?= $teacher['id'] ?>">
                                                <?= htmlspecialchars($teacher['name']) ?> (<?= htmlspecialchars($teacher['subject']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_name">Student Name</label>
                                    <input type="text" id="student_name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="student_age">Age</label>
                                    <input type="number" id="student_age" name="age" required min="5" max="25">
                                </div>
                                <div class="form-group">
                                    <label for="student_grade">Grade</label>
                                    <input type="text" id="student_grade" name="grade" required>
                                </div>
                                <button type="submit">Save Information</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">All Students</div>
                        <div class="card-body">
                            <?php if (empty($students)): ?>
                                <div class="empty-state">No students found.</div>
                            <?php else: ?>
                                <table>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        function openTab(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            const tabButtons = document.querySelectorAll('.tab');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });
            
            document.getElementById(tabName).classList.add('active');
            event.currentTarget.classList.add('active');
        }
        
        // Show alerts
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            if (successAlert) {
                successAlert.classList.add('show');
                setTimeout(() => {
                    successAlert.classList.remove('show');
                }, 5000);
            }
            
            if (errorAlert) {
                errorAlert.classList.add('show');
                setTimeout(() => {
                    errorAlert.classList.remove('show');
                }, 5000);
            }
        });
    </script>
</body>
</html>