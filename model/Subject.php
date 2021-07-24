<?php
    namespace Model;
    use PDO;
    use PDOException;

    class Subject{
    private PDO $connect;

    public function __construct()
    {
        $this->connect = (new Config())->connection;
    }

    public function allSubject(): array
    {
        try {
            $q = "select * from subject_list";
            $stm = $this->connect->prepare($q);
            $stm->execute();
            return array(
                'status' => true,
                'count' => $stm->rowCount(),
                'data' => $stm->fetchAll(),
            );
        }catch (PDOException $PDOException){
            return array(
                'status' => true,
                'error' => $PDOException
            );
        }

    }

    public function subjectName($subject_id): array
    {
        try {
            $q = "SELECT * FROM subject_list WHERE subject_list_id= " .$subject_id;
            $stmt = $this->connect->prepare($q);
            $stmt->execute();
            return array(
                'status' => true,
                'count' => $stmt->rowCount(),
                'data' => $stmt->fetchAll()
            );
        }catch (PDOException $PDOException){
            return array(
                'status' => true,
                'error' => $PDOException
            );
        }
    }


}

