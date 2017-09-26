<?php
namespace Todo;

class Task
{

    protected $title;

    protected $status;

    protected $createdAt;

    protected $tableName = 'tasks';

    function __construct()
    {
        $this->db = DBConn::getInstance();
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($v)
    {
        $this->title = $v;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($v)
    {
        $this->status = $v;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($v)
    {
        $this->createdAt = $v;
    }

    public function save($task)
    {
        $saveSql = "";
        foreach ($task as $k => $v) $saveSql .= " {$k} = '".$v."' , ";
        $saveSql = rtrim($saveSql, ', ');

        $stmt = $this->db->conn->prepare("INSERT INTO  ".$this->tableName." SET $saveSql ");

        return $stmt->execute();
    }


    public function getTasks($id)
    {
        try {
            $stmt = $this->db->conn->prepare("SELECT * FROM ".$this->tableName." WHERE 1 ORDER BY created_at ASC");
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        //Queries database with prepared statement
        return $result;
    }

    public function getTask($id)
    {
        try {

            $stmt = $this->db->conn->prepare("SELECT * FROM ".$this->tableName." WHERE id = :taskid");
            $stmt->bindParam(':taskid', $id);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        //Queries database with prepared statement
        return $result;
    }

    public function updateTask($id, $data)
    {
        try {
            // prepare sql and bind parameters
            $updateSql = "";
            foreach($data as $k => $v) $updateSql .= " {$k} = '".$v."', ";
            $updateSql = rtrim($updateSql, ', ');

            $stmt = $this->db->conn->prepare("UPDATE $this->tableName  SET $updateSql WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $resp = $stmt->execute();

        } catch (\PDOException $v) {
            $err = 'Error: ' . $v->getMessage();
            $resp = false;
        }
        //Determines returned value ('true' or error code)
        return $resp;
    }

    public function updateTasks($tasksIds, $data)
    {
        try {
            // prepare sql and bind parameters
            $updateSql = "";
            foreach($data as $k => $v) $updateSql .= " {$k} = '".$v."', ";
            $updateSql = rtrim($updateSql, ', ');
echo "UPDATE $this->tableName  SET $updateSql WHERE IN (".implode(',', $tasksIds).")";
            exit();
            $stmt = $this->db->conn->prepare("UPDATE $this->tableName  SET $updateSql WHERE IN (".implode(',', $tasksIds).")");
            $resp = $stmt->execute();

        } catch (\PDOException $v) {
            $err = 'Error: ' . $v->getMessage();
            $resp = false;
        }
        //Determines returned value ('true' or error code)
        return $resp;
    }

}