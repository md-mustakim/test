<?php
class Subject{
    private $connect;
    private $table = "subject_list";




    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function all_subject()
    {
        $q = "select * from ".$this->table;
        $stm = $this->connect->prepare($q);
        $stm->execute();
        $this->allClassCount = $stm->rowCount();
        return $stm->fetchAll();

    }

    public function subject_name($subject_id)
    {
        $q = "SELECT * FROM ".$this->table." WHERE subject_list_id=".$subject_id;
        $stmt = $this->connect->prepare($q);
        $stmt->execute();
        return (object)$stmt->fetch();
    }


}

