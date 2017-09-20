<?php
namespace Wouerner;

class Database
{
    private $con = null;

    public function __construct()
    {
        try {
            $this->con = new \PDO('sqlite:'.__DIR__.'/db.sqlite');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function all()
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
        $sql = "INSERT INTO Chain (
                  'id', 'prev_hash', 'hash', 'data'
              ) VALUES (
                  ?, ?, ?, ?
              )";

        $stm = $this->con->prepare($sql);

        $stm->bindParam(1, $id);
        $stm->bindParam(2, $prev_hash);
        $stm->bindParam(3, $hash);
        $stm->bindParam(4, $data);

        $result = $stm->execute();
        return $result;
    }
}
