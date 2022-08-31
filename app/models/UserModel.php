<?php
class UserModel extends Model
{
    private $table = "users";

    public function tableName()
    {
        return "users";
    }
    public function fieldName()
    {
        return "*";
    }
    public function getDetails($id)
    {
        $arr =  $this->db->query("SELECT users.id,email,name,lastName,phone,gender,birthday,phone,street,subDistrict,district,city FROM users,users_information WHERE users.id = users_information.user_id && users.id = $id")->fetch(PDO::FETCH_ASSOC);
        echo "<pre>";
        var_dump($arr);
    }
    public function getList($quantityUsers = 10, $page = 1)
    {
        if ($page == 1) {
            $skipPage = 0;
        } else {
            $skipPage = ($page - 1) * $quantityUsers;
        }


        $totalUsers = $this->db->table("users")
            ->select("COUNT(id) as {$this->tableName()}")->first();

        $totalOfPage = ceil($totalUsers[$this->tableName()] / $quantityUsers);

        if ($page > $totalOfPage) {
            App::$app->loadError("404");
        }

        $arrUsers = $this->db->table($this->tableName())
            ->select("users.id,lastName,name,gender,birthday,phone,street,subDistrict,district,city,email")
            ->leftjoin("users_information", "users.id", "=", "users_information.user_id")
            ->limit($quantityUsers, $skipPage)
            ->orderBy("id", "ASC")
            ->get();
        $data['arrayUser'] = $arrUsers;
        $data['totalOfPage'] = $totalOfPage;

        $numberShowPagination = 2;

        $start  = ($page - $numberShowPagination) > 0 ? $page - $numberShowPagination : 1;
        $end = ($page + $numberShowPagination < $totalOfPage) ? $page + $numberShowPagination : $totalOfPage;


        $html = '<ul class="pagination pagination-sm m-0">';
        $html .= ($page == 1) ? '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>' : '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo;</a></li>';

        if ($start > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
            $html .= '<li class="page-item disabled"><a class="page-link" href="">...</a></li>';
        }
        for ($i = $start; $i <= $end; $i++) {
            $html .= '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $totalOfPage) {
            $html .= '<li class="page-item disabled"><a class="page-link" href="">...</a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="?page=' . $totalOfPage . '">' . $totalOfPage . '</a></li>';
        }

        $html .= ($page == $totalOfPage) ? '<li class="page-item disabled"><a class="page-link" href="">&raquo;</a></li>' : '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">&raquo;</a></li>';
        $html .= '</ul>';
        $data['pagination'] = $html;
        return $data;
    }
    public function createUsers($data = [])
    {
        $result = $this->db->create($this->tableName(), $data);
        return $result;
    }
    public function lastID()
    {
        return $this->db->lastInsertIdCreate();
    }
}
