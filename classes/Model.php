<?php
namespace Todo;
class Model
{

    private $tablename = "";

    protected static $table;

    protected $db;


    public function getTablename()
    {
        return (!empty($this->tablename) ? $this->tablename : static::$table);
    }

    public function setTablename($value)
    {
        $this->tablename = $value;
    }

    function save($data)
    {
        $table = (!empty($this->tablename) ? $this->tablename : static::$table);
        $this->db->insert($table, $data);
        return $this->db->insertedId();
    }

    function update($id, $data)
    {
        $res	   = 0;
        $result = "";
        $table   = (!empty($this->tablename) ? $this->tablename : static::$table);
        if (is_array($result) && !empty($result)) {
            $data = array_merge($data, $result);
        }
        $this->db->update($table, $data, "id={$id}");
        return $this->db->affected_rows();

    }

    public function verifyUser($id, $data)
    {
        try {
            // prepare sql and bind parameters
            $vstmt = $vdb->conn->prepare('UPDATE '.$tbl_members.' SET verified = :verify WHERE id = :uid');
            $vstmt->bindParam(':uid', $uid);
            $vstmt->bindParam(':verify', $verify);
            $vstmt->execute();

        } catch (PDOException $v) {

            $verr = 'Error: ' . $v->getMessage();

        }

        //Determines returned value ('true' or error code)
        $resp = ($verr == '') ? 'true' : $verr;

        return $resp;
    }

}
