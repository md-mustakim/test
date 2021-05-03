<?php
    namespace Controller;
    use Model\Student;
    use Model\Class_list;



    class dashboard{

        public function classView(): array
        {
            $class_list = new Class_list();
            $student = new Student();

            foreach ($class_list->all_class()['data'] as $item => $value)
            {
                $classId = $value['class_id'];
                $class_name = $value['class_name'];
                $shift = $class_list->shift_name($value['shift']);
                $classPerStudent = $student->perClassStudent($classId);
                $ap[] = array($class_name, $shift['shift_name'], $classPerStudent);
                ;
            }
            return $ap;

        }

    }