<?php
    namespace Controller;
    require __DIR__."/../model/Student.php";
    require __DIR__."/../model/Class_list.php";
    require __DIR__."/../model/Config.php";
    require __DIR__."/../model/Attendance.php";
    use PDO;
    use PDOException;
    use Model\Student;
    use Model\Class_list;
    use Model\Config;
    use Model\Attendance;
    class attendanceController{
        private $student;

        private Class_list $class_list;
        private PDO $connect;
        public string $date;
        public string $month;
        public string $year;
        public string $count;
        public int $class;
        public array $attend_data;
        public Attendance $attendance;


        public function __construct()
        {
            $co = new config();
            $this->connect =  (new Config())->connection;
            $this->student = new student();
            $this->class_list = new Class_list();
            $this->attendance = new Attendance();

        }
        public function attend_status(): bool
        {
            return $this->attendance->status($this->date,$this->month,$this->year,$this->class);
        }

        public function index(){
            $q = "SELECT * FROM attandance where year=".$this->year." and month=".$this->month." and date=".$this->date;
            $stmt = $this->connect->prepare($q);
            $stmt->execute();
            return $stmt->rowCount();
        }
        public function dashboard(){
            $day_count = cal_days_in_month(0,$this->month,$this->year);
            $result = array();
            for ($i=1; $i<=$day_count;$i++)
            {
                $this->date = $i;
                $count_attend = $this->index();
                $full_date = $this->date."-".$this->month."-".$this->year;
                $day = date('l', strtotime($this->month."/".$this->date."/".$this->year));
                if($count_attend<1)
                {
                    $result[]= array(
                        'status' => false,
                        'full_date' => $full_date,
                        'day' => $day,
                        'date' => $this->date,
                        'month' => $this->month,
                        'year' => $this->year,
                        'message' => "Attendance are not taken OR Off day"
                    );
                }else
                {
                    $this->student->allStudent();
                    $attend_percent = number_format(($count_attend*100) / $this->student->allStudent()['count'],2);
                    $count_class_q = "SELECT DISTINCT cls FROM attandance WHERE month = ".$this->month." AND year=".$this->year. " ORDER BY cls ASC";
                    $stmt  = $this->connect->prepare($count_class_q);
                    $stmt->execute();
                    $class_list = $stmt->fetchAll();

                    $attended_class_count_query = "select DISTINCT cls from attandance WHERE month = ".$this->month." AND year=".$this->year." AND date=".$this->date;
                    $stmto = $this->connect->prepare($attended_class_count_query);
                    $stmto->execute();
                    $class_count = $stmto->rowCount();

                    $full_date = $this->date."-".$this->month."-".$this->year;
                    $result[] = array(
                        'status' => true,
                        'day' => $day,
                        'full_date' => $full_date,
                        'date' => $this->date,
                        'month' => $this->month,
                        'year' => $this->year,
                        'count_class' => $class_count." Out of ".$this->class_list->all_class()['count'],
                        'percent' => $attend_percent
                    );

                }

            }
            return $result;
        }

        public function show_attendance_by_date()
        {
            $attend_data= $this->attendance->show_attendance_by_date($this->date,$this->month,$this->year,$this->class);
            $res = array();
            foreach ($attend_data as $item => $value)
            {
                $class_name = $this->class_list->classAndShiftName($value['class']);
                $res[] =array(
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'class' => $class_name,
                    'class_roll' => $value['class_roll'],
                    'attend' => $value['attand'],
                );
            }



            // calculate data
            $total_student = $this->student->perClassStudent($this->class);
            if($total_student <1)
            {
                $status = true;
                $calculate_data = array();

            }else{

                $absent_student= $this->attendance->absent($this->date,$this->month,$this->year,$this->class);
                $present_student= $this->attendance->present($this->date,$this->month,$this->year,$this->class);

                $presence = number_format(($present_student * 100) / $total_student,2);
                $calculate_data= array(
                    'totalStudent' => $total_student,
                    'present' => $present_student,
                    'absent' => $absent_student,
                    'presence' => $presence,
                );
                $status = $this->attendance->status($this->date,$this->month,$this->year,$this->class);
            }

            return array(
                'status' => $status,
                'res' => $res,
                'calculate_data' => $calculate_data,

            );
        }
        public function attend_percent($date,$month,$year,$class){

            $total_student = $this->student->perClassStudent($class);
            if($total_student <1)
            {

                $calculate_data = array(
                    'status' => 2
                );

            }else{

                $absent_student= $this->attendance->absent($date,$month,$year,$class);
                $present_student= $this->attendance->present($date,$month,$year,$class);

                $presence = number_format(($present_student * 100) / $total_student,2);
                $status = $this->attendance->status($date,$month,$year,$class);
                $calculate_data= array(
                    'status' => $status,
                    'totalStudent' => $total_student,
                    'present' => $present_student,
                    'absent' => $absent_student,
                    'presence' => $presence,
                );

            }

            return $calculate_data;
        }





        public function show_classList()
        {
            return $this->class_list->class_shift();
        }
        public function allStudentCount($class_id)
        {
            if(isset($class_id))
            {
                $this->student->allStudent();
                return $this->student->allStudent()['count'];

            }else{
                $this->student->showStudentByClass($class_id);
                return $this->student->allStudent()['count'];
            }

        }

        public function isAttent()
        {
            $q = "SELECT * FROM student_info 
            RIGHT JOIN attandance ON 
            student_info.uniqueid = attandance.unid
             WHERE attandance.cls=".$this->class."
              AND
              attandance.date LIKE '".$this->date."'";
            $stmt = $this->connect->prepare($q);
            $result = $stmt->execute();
             if($stmt->rowCount() > 0)
             {
                 return false;
             }else
             {
                 return true;
             }
        }





        public function attendList(){
            return $this->student->perClassStudentShow($this->class);
        }

        /**
         * @return object
         */
        public function getClassList()
        {
            return (object)$this->class_list->class_shift();
        }


        public function takeAttendance(){

            foreach ($this->attend_data as $unid => $attend)
            {
                $data[] = array(
                    $unid, $this->class, $attend, $this->date, $this->month,$this->year
                );

            }
            $query = "INSERT INTO `attandance`(`unid`, `cls`, `attand`, `date`, `month`, `year`) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect->prepare($query);
            try {
                $this->connect->beginTransaction();
                foreach ($data as $row)
                {
                    $stmt->execute($row);
                }
                $this->connect->commit();
                return true;
            }catch (PDOException $PDOException)
            {
                $this->connect->rollback();
                return $PDOException;
            }




        }

    }