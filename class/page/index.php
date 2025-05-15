<?php
session_start();

require_once "../models/School.php";
require_once "../models/Student.php";
require_once "../models/Teacher.php";
require_once "../controllers/form_logic_process.php";


$title = "Day Activity - 10";
$load = false;
ob_start();
// for data strord in text file
include "../services/init_files.php";
include "../services/getAll_data.php";

$services = ob_get_clean();
?>

<?php ob_start() ?>
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
    <?php $content = ob_get_clean() ?>

    <?php ob_start() ?>
<script src="../assets/js/scripts.js"></script>

<?php $scripts = ob_get_clean() ?>

<!-- Layout  -->

<?php require_once "../views/layout.php" ?>