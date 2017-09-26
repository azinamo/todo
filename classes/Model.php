<?php
namespace Todo;
class Model
{

    private $tablename = "";

    protected static $table;

    protected $db;

    function __construct()
    {
        $this->db = DBConn::getInstance();
    }

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

}
