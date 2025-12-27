<?php
require 'StudentManager.php';
$student_manager = new StudentManager();
echo "Welcome To Student Manager App!\n";
while (true) {
    $students = $student_manager->get_all_students();
    $options = $students ? ["Add Student", "Show Students Number","Remove Student", "Update Student Degree", "Display All Students", "Display Student", "Exit"] : ["Add Student", "Exit"];
    foreach ($options as $index => $option) {
        echo $index + 1 . "- $option\n";
    }
    echo "Enter Your Choice Number (press enter to exit): ";
    $user_choice = trim(fgets(STDIN));
    if (strlen($user_choice) === 0):
        $student_manager->exit_program();
    endif;
    if ($students) {
        switch ($user_choice) {
            case "1":
                $student_manager->handelAddingStudent();
                break;
            case "2":
                echo $student_manager->messageDesign("studnets number is: $student_manager->numer_of_students", "-", 30);
                break;
            case "3":
                echo "Enter Student ID (Press enter to previous): ";
                $student_id = trim(fgets(STDIN));
                if (strlen($student_id) == 0) {
                    continue 2;
                }
                if ($student_manager->check_id($student_id)) {
                    $student_manager->remove_student($student_id);
                } else {
                    continue 2;
                }
                break;
            case "4":
                echo "Enter Student ID (Press enter to previous): ";
                $student_id = trim(fgets(STDIN));
                if (strlen($student_id) === 0):
                    continue 2;
                endif;
                if ($student_manager->check_id($student_id)) {
                    echo "Enter New Degree: ";
                    $student_degree = trim(fgets(STDIN));
                    $student_manager->update_degree($student_id, $student_degree);
                    break;
                } else {
                    continue 2;
                }
            case "5":
                $student_manager->display_students();
                break;
            case "6":
                echo "Enter Student ID (Press enter to previous): ";
                $student_id = trim(fgets(STDIN));
                if (strlen($student_id) == 0) {
                    continue 2;
                }
                if ($student_manager->check_id($student_id)) {
                    $student_manager->display_student_info($student_id);
                    break;
                } else {
                    continue 2;
                }
            case "7":
                $student_manager->exit_program();
            default:
                $student_manager->default_case($options);
                continue 2;
        }
    } else {
        switch ($user_choice) {
            case "1":
                $student_manager->handelAddingStudent();
                break;
            case "2":
                $student_manager->exit_program();
                break;
            default:
                $student_manager->default_case($options);
                continue 2;
        }
    }
}