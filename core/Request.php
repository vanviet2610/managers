<?php
class Request
{
    private $rule = [], $message = [], $error = [];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        if ($this->getMethod() == "get") {
            return true;
        }
        return false;
    }
    public function isPost()
    {
        if ($this->getMethod() == "post") {
            return true;
        }
        return false;
    }

    public function getFieldAll()
    {
        $datafield = [];
        if ($this->isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if (is_array($value)) {
                        $datafield[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $datafield[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $datafield;
    }

    public function rule($ruleArr = [])
    {
        return $this->rule = $ruleArr;
    }

    public function message($message = [])
    {
        return $this->message = $message;
    }


    public function postFieldAll()
    {
        $datafield = [];
        if ($this->isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $datafield[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $datafield[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $datafield;
    }

    public function validate()
    {
        $datafield = array_filter($this->postFieldAll());

        $checkValidate = true;

        foreach ($this->rule as $fieldName => $ruleItem) {
            $ruleItemArr = explode("|", $ruleItem);

            foreach ($ruleItemArr as $rule) {
                $ruleName = null;
                $ruleValue = null;

                $ruleArr = explode(":", $rule);
                $ruleName = reset($ruleArr);

                if (count($ruleArr) > 1) {
                    $ruleValue =  end($ruleArr);
                }

                if ($ruleName == "unique") {
                    if (!empty($datafield[$fieldName])) {
                        if (!empty($ruleArr[1]) && !empty($ruleArr[2])) {
                            $check =   $this->db->table($ruleArr[1])->select()->where($ruleArr[2], "=", $datafield[$fieldName])->get();
                            if (!empty($check)) {
                                $this->setError($fieldName, $ruleName);
                                $checkValidate = false;
                            }
                        } else {
                            App::$app->loadError("request");
                            $checkValidate = false;
                            exit;
                        }
                    }
                }
                if ($ruleName == "required") {
                    if (empty($datafield[$fieldName])) {
                        $this->setError($fieldName, $ruleName);
                        $checkValidate = false;
                    }
                }
                if ($ruleName == "number") {
                    if (!empty($datafield[$fieldName])) {
                        if (!preg_match('~^0[0-9]{1,9}~', $datafield[$fieldName])) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                }
                if ($ruleName == "min") {
                    if (!empty($datafield[$fieldName]) && strlen(trim($datafield[$fieldName])) < $ruleValue) {
                        $this->setError($fieldName, $ruleName);
                        $checkValidate = false;
                    }
                }
                if ($ruleName == "max") {
                    if (!empty($datafield[$fieldName]) && strlen(trim($datafield[$fieldName])) > $ruleValue) {
                        $this->setError($fieldName, $ruleName);
                        $checkValidate = false;
                    }
                }
                if ($ruleName == "email") {
                    if (!empty($datafield[$fieldName])) {
                        if (!filter_var($datafield[$fieldName], FILTER_VALIDATE_EMAIL)) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                }
            }
        }

        return $checkValidate;
    }

    public function errors($fieldName = "")
    {
        if (!empty($this->error)) {
            if (empty($fieldName)) {
                foreach ($this->error as $key => $value) {
                    $errorField[$key] = reset($value);
                }
                return $errorField;
            } else {
                return reset($this->error[$fieldName]);
            }
        }
        return false;
    }

    public function setError($fieldName, $ruleName)
    {
        $this->error[$fieldName][$ruleName] = $this->message[$fieldName . "." . $ruleName];
    }



}
