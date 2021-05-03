<?php
    namespace Controller;
    use Model\Config;
    use Model\Student;
    use Model\Class_list;
    use PDO;
class payment{
    private PDO $connect;
    private Class_list $class_list;
    private int $student_id;


    public string $name;
    public string $class;
    public string $father_name;
    public string $father_number;
    public string $mother_name;
    public string $mother_number;
    public string $birth_day;
    public string $amount;
    public string $address;
    public string $class_roll;
    public int $status;
    /**
     * @var student
     */
    private Student $student;


    public function __construct($student_id)
    {
        $this->student_id = $student_id;
        $connect = new config();
        $this->connect = $connect->connection;
        $this->class_list = new Class_list();
        $this->student = new student();
    }


    public function show_student(): array
    {
        return $this->student->show($this->student_id);
    }

    public function update(): bool
    {
        $q = "UPDATE student_info SET name=?, class=?, fname=?, fnumber=?, mname=?, mnumber=?, birth=?, address=?, amount=?, status=?, class_roll=? WHERE id=?";
        $stmt =$this->connect->prepare($q);
        $value = [$this->name,$this->class,$this->father_name,$this->father_number,$this->mother_name,$this->mother_number,$this->birth_day,$this->address,$this->amount,$this->status,$this->class_roll,$this->student_id];
        return $stmt->execute($value);
    }

    public function all_class_shift(): array
    {
        return $this->class_list->class_shift();
    }


}