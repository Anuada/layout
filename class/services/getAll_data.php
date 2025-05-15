<?php 

// Get all data for display
$schools = unserialize(file_get_contents('schools.txt')) ?: [];
$teachers = unserialize(file_get_contents('teachers.txt')) ?: [];
$students = unserialize(file_get_contents('students.txt')) ?: [];

?>
