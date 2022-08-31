<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <p class="h3">Quản Lý Sinh Viên</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item h5">Thêm Sinh Viên</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card card-info shadow">
                    <div class="card-header">
                        <h3 class="card-title">Thêm Sinh Viên</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php
                                        echo _WEB_ROOT . "home/add"
                                        ?>
                        " method="post" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("name", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="name" value="<?php echo (!empty($old) && array_key_exists("name", $old)) ?  $old['name'] : ''; ?>" placeholder="Tên">
                                <?php
                                echo (!empty($error) && array_key_exists("name", $error)) ?  "<span class='error invalid-feedback'>$error[name] </span>" : '';
                                ?>

                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("lastName", $error)) ?  'is-invalid' : '';
                                                                        ?>" value="<?php echo (!empty($old) && array_key_exists("lastName", $old)) ?  $old['lastName'] : ''; ?>" name="lastName" placeholder="Họ Tên">
                                <?php
                                echo (!empty($error) && array_key_exists("lastName", $error)) ?  "<span class='error invalid-feedback'>$error[lastName] </span>" : '';
                                ?>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("birthday", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="birthday" value="<?php
                                                                                                    echo (!empty($old) && array_key_exists("birthday", $old)) ?  $old['birthday'] : ''; ?>" placeholder="Ngày Sinh">
                                <?php
                                echo (!empty($error) && array_key_exists("birthday", $error)) ?  "<span class='error invalid-feedback'>$error[birthday] </span>" : '';
                                ?>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                                </div>
                                <input type="text" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("street", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="street" placeholder="Số nhà" value="<?php echo (!empty($old) && array_key_exists("street", $old)) ?  $old['street'] : ''; ?>">

                                <?php
                                echo (!empty($error) && array_key_exists("street", $error)) ?  "<span class='error invalid-feedback'>$error[street] </span>" : '';
                                ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                                </div>
                                <input type="text" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("subDistrict", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="subDistrict" placeholder="Phường Xã" value="<?php echo (!empty($old) && array_key_exists("subDistrict", $old)) ?  $old['subDistrict'] : ''; ?>">
                                <?php
                                echo (!empty($error) && array_key_exists("subDistrict", $error)) ?  "<span class='error invalid-feedback'>$error[subDistrict] </span>" : '';
                                ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                                </div>
                                <input type="text" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("district", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="district" placeholder="Quận Huyện" value="<?php echo (!empty($old) && array_key_exists("district", $old)) ?  $old['district'] : ''; ?>">
                                <?php
                                echo (!empty($error) && array_key_exists("subDistrict", $error)) ?  "<span class='error invalid-feedback'>$error[subDistrict] </span>" : '';
                                ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                                </div>
                                <input type="text" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("city", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="city" placeholder="Thành Phố" value="<?php echo (!empty($old) && array_key_exists("city", $old)) ?  $old['city'] : ''; ?>">
                                <?php
                                echo (!empty($error) && array_key_exists("city", $error)) ?  "<span class='error invalid-feedback'>$error[city] </span>" : '';
                                ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="tel" class="form-control <?php
                                                                        echo (!empty($error) && array_key_exists("phone", $error)) ?  'is-invalid' : '';
                                                                        ?>" name="phone" maxlength="10" placeholder="Số Điện Thoại" value="<?php echo (!empty($old) && array_key_exists("phone", $old)) ?  $old['phone'] : ''; ?>">
                                <?php
                                echo (!empty($error) && array_key_exists("phone", $error)) ?  "<span class='error invalid-feedback'>$error[phone] </span>" : '';
                                ?>
                            </div>
                            <div class="form-group mb-3">
                                <label>Giới Tính</label>
                                <select name="gender" class="form-control">
                                    <option value="1" selected>Nam</option>
                                    <option value="2">Nữ</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" name="email" class="form-control <?php
                                                                                    echo (!empty($error) && array_key_exists("email", $error)) ?  'is-invalid' : '';
                                                                                    ?>" placeholder="Email" value="<?php echo (!empty($old) && array_key_exists("email", $old)) ?  $old['email'] : ''; ?>">
                                <?php
                                echo (!empty($error) && array_key_exists("email", $error)) ?  "<span class='error invalid-feedback'>$error[email] </span>" : '';
                                ?>
                            </div>
                            <div class="input-group mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>