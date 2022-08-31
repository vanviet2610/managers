<?php


trait QueryBuilder
{
    public $tableName = "";
    public $where = "";
    public $checkWhere = '';
    public $field = "*";
    public $orderBy = "";
    public $limit = "";
    public $join = "";



    public function table($table)
    {
        $this->tableName =  $table;
        return $this;
    }
    public function where($field, $compare, $value)
    {
        if (empty($this->checkWhere)) {
            $this->checkWhere = ' WHERE';
        } else {
            $this->checkWhere = ' AND';
        }
        $this->where .= "$this->checkWhere $field $compare '$value'";
        return $this;
    }

    public function select($field = "*")
    {
        $this->field = $field;
        return $this;
    }

    public function get()
    {
        $sql = "SELECT {$this->field} FROM {$this->tableName} {$this->join} {$this->where} {$this->orderBy} {$this->limit} ";
        $sqlQuery = $this->query($sql);
        $this->resetProperty();
        if (!empty($sqlQuery)) {
            return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
    public function first()
    {
        $sql = "SELECT {$this->field} FROM {$this->tableName} {$this->join} {$this->where} {$this->orderBy} {$this->limit}";
        $sqlQuery = $this->query($sql);
        $this->resetProperty();
        if (!empty($sqlQuery)) {
            return $sqlQuery->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function limit($number, $offset = 0)
    {
        $this->limit = "LIMIT $number OFFSET $offset";
        return $this;
    }

    public function orderBy($field, $type = "ASC")
    {
        $filedArr =  array_filter(explode(",", $field));
        if (!empty($filedArr) && count($filedArr) == 2) {
            $this->orderBy = "ORDER BY " . implode(',', $filedArr);
        } else {
            $this->orderBy = "ORDER BY $field $type";
        }
        return $this;
    }

    public function join($table, $columNameTableFirst, $compare, $columNameTableTwo)
    {
        $this->join = "INNER JOIN $table ON $columNameTableFirst $compare $columNameTableTwo";
        return $this;
    }

    public function leftjoin($table, $columNameTableFirst, $compare, $columNameTableTwo)
    {
        $this->join = "LEFT JOIN $table ON $columNameTableFirst $compare $columNameTableTwo";
        return $this;
    }

    public function rightjoin($table, $columNameTableFirst, $compare, $columNameTableTwo)
    {
        $this->join = "RIGHT JOIN $table ON $columNameTableFirst $compare $columNameTableTwo";
        return $this;
    }

    public function fulljoin($table, $columNameTableFirst, $compare, $columNameTableTwo)
    {
        $this->join = "FULL OUTER JOIN  $table ON $columNameTableFirst $compare $columNameTableTwo";
        return $this;
    }

    public function resetProperty()
    {
        $this->tableName = "";
        $this->where = "";
        $this->checkWhere = '';
        $this->field = "*";
        $this->orderBy = "";
        $this->limit = "";
    }
}
