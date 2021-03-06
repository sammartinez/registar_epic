<?php

    class Course {

        private $id;
        private $course_name;
        private $course_number;


        //Constructors
        function __construct($course_name,$course_number,$id = null)
        {
          $this->course_name = $course_name;
          $this->course_number = $course_number;
          $this->id = $id;
        }

        //Getters
        function getCourseName()
        {
            return $this->course_name;
        }

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function getId()
        {
            return $this->id;
        }

        //Setters
        function setCourseName($new_course_name)
        {
            $this->course_name = (string) $new_course_name;
        }

        function setCourseNumber($new_number)
        {
            $this->course_number = (int) $new_number;
        }


        function save()
        {
            $statement = $GLOBALS['DB']->exec("INSERT INTO courses(course_name, course_number) VALUES ('{$this->getCourseName()}', {$this->getCourseNumber()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //STATIC

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();

            foreach($returned_courses as $course) {
                $course_name = $course['course_name'];
                $id = $course['id'];
                $number = $course['course_number'];
                $new_course = new Course($course_name, $number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

    }


 ?>
