<?php
namespace Wouerner;

class Database
{
    private $con = null;

    public function __construct()
    {
        try {
            $this->con = new \PDO('sqlite:'.__DIR__.'/db.sqlite');
        }
        catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function select()
    {
        $sql = "
                SELECT *
                from Chain
                ";

        $stm = $this->con->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($id, $prev_hash, $hash, $data)
    {
        $sql = "
                SELECT *
                from Chain
                ";

        $stm = $this->con->prepare($sql);

        $result = $stm->execute();
        return $result;
    }
}


