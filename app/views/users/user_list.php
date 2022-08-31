<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <p class="h4">Quản Lý Sinh Viên</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item h5">Danh Sách</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <?php
        if (!empty(Session::dataSession("msg"))) {
            echo '<div class="row">
           <div class="col-12">
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h5><i class="icon fas fa-check"></i> Thông Báo!</h5>';
            echo Session::flash("msg");
            echo    '</div>
           </div>
       </div>';
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg rounded">
                    <div class="card-header">
                        <h3 class="card-title"><b style="color: limegreen;">Tổng Danh Sách Sinh Viên</b></h3>
                        <div class="card-tools">
                            <a href="<?php echo _WEB_ROOT . 'home/create' ?>" class="float-right">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ Và Tên</th>
                                    <th>Ngày Sinh</th>
                                    <th>Giới Tính</th>
                                    <th>Email</th>
                                    <th>Số Điên Thoại</th>
                                    <th>Địa Chỉ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($arrayUser as $key => $value) {

                                ?>
                                    <tr>
                                        <td><?php echo $page == 1 ? $key + 1 : ($page - 1) * 10 + $key + 1  ?></td>
                                        <td><?php echo $value['lastName'] . " " . $value['name']  ?></td>
                                        <td><?php echo $value['birthday'] ?></td>
                                        <td><?php echo $value['gender'] == 1 ? "Nam" : "Nữ"  ?></td>
                                        <td><?php echo $value['email'] ?></td>
                                        <td><?php echo $value['phone'] ?></td>
                                        <td><?php echo $value['street'] . " " . $value["subDistrict"] . " " . $value["district"] . " " . $value['city'] ?></td>
                                        <td>
                                            <a href="./userinformation.html"><i class="text-info fas fa-eye"></i></a>
                                            <a href="<?php echo _WEB_ROOT . 'home/details/' . $value['id'] ?>"><i class="ml-1 text-warning fas fa-edit"></i></a>
                                            <a type="button" class="ml-1"><i class="fas fa-trash" style="color: red;"></i></a>
                                        </td>
                                    </tr>
                                <?php }

                                ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</section>