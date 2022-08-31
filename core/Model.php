<?php
abstract class Model extends Database
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    abstract function tableName();
    abstract function fieldName();

    public function getAll(): array
    {
        if (empty($this->fieldName())) {
            $this->fieldName = "*";
        };
        $data = $this->db->query("SELECT {$this->fieldName()} FROM {$this->tableName()}")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


}
