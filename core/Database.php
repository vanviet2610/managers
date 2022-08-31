<?php
class Database
{
    protected $_connect;
    use QueryBuilder;

    public function __construct()
    {
        global $configs;
        $this->_connect = Connection::getInstance($configs['database']);
    }
    public function query($sql)
    {
        try {
            // $this->_connect->beginTransaction();
            $statment =  $this->_connect->prepare($sql);
            $statment->execute();
            // $this->_connect->commit();
            return $statment;
        } catch (Exception $err) {
            App::$app->loadError("database",  $err->getMessage());
            // $this->_connect->rollBack();
            die;
        }
    }

    public function create($tableName, $data = [])
    {
        $field = "";
        $values = "";
        foreach ($data as $key => $value) {
            $field .= $key  . ",";
            $values .= "'" . $value . "'" . ",";
        }
        $field  = rtrim($field, ",");
        $values = rtrim($values, ",");
        $sqlQuery = "INSERT INTO {$tableName} ({$field}) VALUES ({$values})";
        $result = $this->query($sqlQuery);
        return $result;
    }

    public function lastInsertIdCreate()
    {
        $result = $this->_connect->lastInsertId();
        return $result;
    }
}
