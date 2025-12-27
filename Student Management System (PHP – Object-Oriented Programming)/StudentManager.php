<?php
require_once 'Student.php';

// StudentManager handles storage and management of student objects
class StudentManager
{
    // Stores all students, using ID as key
    private $all_students = [];

    // Counter for total students
    public $numer_of_students = 0;

    /**
     * Add a new student to the manager by unique ID.
     * Prevents duplicate IDs.
     */
    public function add_student($id, $name, $degree)
    {
        // Check if student already exists
        if (isset($this->all_students[$id])) {
            echo "*** This student id is used before, try another id ***\n";
            return;
        }
        // Add new student and increase count
        $this->all_students[$id] = new Student($id, $name, $degree);
        echo "*** Student {$this->all_students[$id]->name} is added successfully. ***\n";
        $this->numer_of_students++;
    }

    /**
     * Remove a student by ID, with message if not found.
     */
    public function remove_student($id)
    {
        if (isset($this->all_students[$id])) {
            echo "*** Student {$this->all_students[$id]->name} is removed successfully. ***\n";
            unset($this->all_students[$id]);
            $this->numer_of_students--;
        } else {
            echo "*** Student With Id $id Not Found ***\n";
        }
    }

    /**
     * Print details of all stored students in formatted manner.
     */
    public function display_students()
    {
        if ($this->all_students) {
            foreach ($this->all_students as $student) {
                $name = $student->name;
                $degree = $student->getDegree();
                echo str_repeat("-", 25) . "\nStudent Name: $name\nStudent Degree: $degree\n" . str_repeat("-", 25) . "\n";
            }
        } else {
            echo "*** No students to display, add students and try again ***\n";
        }
    }
    public function get_all_students()
    {
        return $this->all_students;
    }

    /**
     * Update the degree value for a student via input from the console.
     */
    public function update_degree($id, $new_degree)
    {
        if (isset($this->all_students[$id])) {
            $this->all_students[$id]->setDegree($new_degree);
            echo "*** Student Degree Updates Successfully. ***\n";
        } else {
            if (strlen($id) == 0) {
                return;
            }
            echo "*** Student With Id $id Not Found ***\n";
        }
    }
    public function check_id($id)
    {
        if (!isset($this->all_students[$id])):
            echo "*** Student With Id $id Not Found ***\n";
            return false;
        else:
            return true;
        endif;
    }

    /**
     * Display detailed info for a single student by ID.
     */
    public function display_student_info($id)
    {
        if (isset($this->all_students[$id])) {
            $name = $this->all_students[$id]->name;
            $degree = $this->all_students[$id]->getDegree();
            $this->messageDesign("Student Name: $name\nStudent Degree: $degree", "-", 25);
        } else {
            if (strlen($id) === 0){
                return;
            }
            echo "*** Student With Id $id Not Found ***\n";
        }
    }
    public function exit_program()
    {
        echo "Thanks For Using Our Program, Have A Nice Day 😊";
        exit;
    }
    public function default_case($list)
    {
        $this->messageDesign("Please Choice a number between (1 - " . count($list) . ")", "-", 40);
    }
    public function handelAddingStudent()
    {
        echo "Enter Student Details in this format (id, name, degree) Press enter to previous: ";
        $student_data = trim( trim(fgets(STDIN)));
        if (strlen($student_data) == 0) {
            return;
        }
        $student_data = explode(",", $student_data);
        if (count($student_data) < 3 || count($student_data) > 3) {
            echo "*** Please Enter The Data In Correct Format (id, name, degree). ***\n";
            return;
        }
        if (is_numeric($student_data[1]) ||  !str_replace(" ", "", $student_data[1])) {
            echo "*** Please enter correct name and try again. ***\n";
            return;
        }
        $this->add_student((string) trim($student_data[0]), (string) trim($student_data[1]), (float) $student_data[2]);
        return;
    }
    /*
    this function used to display data in user friendly way like this:

    -------------------------
    Student Name: alhussien
    -------------------------
    */
    public function messageDesign($massage, $sperator, $repeate)
    {
        echo str_repeat($sperator, $repeate) . "\n$massage\n" . str_repeat($sperator, $repeate) . "\n";
    }
}

