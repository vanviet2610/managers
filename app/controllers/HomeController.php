<?php
class HomeController extends Controller
{
    public $userModel, $userInforModel;
    private $data = [];
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->userInforModel = $this->model('UserInforModel');
    }
    public function index()
    {
        $quantityUsers = 10;
        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->data['content'] = 'users/user_list';
        $this->data['sub_content'] = array_filter($this->userModel->getList($quantityUsers, $page));
        $this->data['sub_content']['page'] = $page;
        $this->renderViews("masterlayout/dashboard", $this->data);
    }
    public function details($id)
    {
        $this->data['content'] = 'users/user_edit';
        $this->data['sub_content'] = "";
        $this->userModel->getDetails(29);
        // $this->renderViews("masterlayout/dashboard", $this->data);
    }
    public function create()
    {
        $this->data['content'] = "users/user_create";
        $this->data['sub_content']['old'] = Session::flash("old");
        $this->data['sub_content']['error'] = Session::flash("error");
        $this->renderViews("masterlayout/dashboard", $this->data);
    }

    public function add()
    {
        $request = new Request();
        $res = new Respone();

        $request->rule(
            [
                'name' => 'required|min:3',
                'lastName' => 'required',
                'birthday' => 'required',
                'street' => 'required',
                'subDistrict' => 'required',
                'district' => 'required',
                'city' => 'required',
                'gender' => 'required',
                'phone' => 'required|number|min:10',
                'email' => 'required|email|unique:users:email',
            ]
        );
        $request->message([
            'name.required' => 'Vui lòng nhập tên',
            'name.min' => 'Vui lòng nhập tên không nhỏ hơn 3 ký tự',
            'lastName.required' => 'Vui lòng nhập họ tên',
            'birthday.required' => 'Vui lòng nhập ngày sinh ',
            'street.required' => 'Vui lòng nhập địa chỉ số nhà',
            'subDistrict.required' => 'Vui lòng nhập phường xã',
            'district.required' => 'Vui lòng nhập vui lòng nhập quận huyện',
            'city.required' => 'Vui lòng nhập thành phố',
            'gender.required' => 'Vui lòng nhập giới tính',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.number' => 'Nhập bằng số và bắt đầu bằng số 0',
            'phone.min' => 'Số điện thoại bằng 10 số',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email này đã tồn tại '
        ]);
        $formRequest = $request->postFieldAll();
        if (!$request->validate()) {
            Session::dataSession("old", $formRequest);
            Session::dataSession("error", $request->errors());
            $res->redirect("home/create");
        } else {
            try {
                $users = $this->userModel->createUsers([
                    "email" => $formRequest["email"],
                    "password" => "123123"
                ]);
                unset($formRequest['email']);
                if (!empty($users) && $this->userModel->lastID() != 0) {
                    $formRequest['user_id'] = $this->userModel->lastID();
                    $this->userInforModel->createInformation($formRequest);
                    Session::dataSession("msg", "đăng ký thành công");
                    $res->redirect("home/index");
                }
            } catch (Exception $err) {
                App::$app->loadError("500", $err->getMessage());
                die();
            }
        }
    }
}
