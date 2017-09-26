<?php
namespace Todo;

class Task extends Model
{

    private $title;

    private $status;

    private $createdAt;

    public function __construct()
    {

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
        return $this->save($task);
    }

    public function update($id, $task)
    {
        return $this->update($id, $task);
    }

    public function getAll()
    {

    }
}