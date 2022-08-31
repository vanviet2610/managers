<?php

class UserInforModel extends Model
{

    public function tableName()
    {
        return "users_information";
    }
    public function fieldName()
    {
        return "*";
    }
    public function createInformation($data = [])
    {
        $result =   $this->db->create($this->tableName(),$data);
        return $result;
    }
}
