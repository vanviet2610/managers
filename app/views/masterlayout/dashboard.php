<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản Lý</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://localhost/manageruser/app/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost/manageruser/app/public/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed" style="height: auto;">
    <div class="wrapper">
        <?php
        $this->renderViews('masterlayout/header'); ?>
        <div class="content-wrapper">

            <?php
            $this->renderViews($content, $sub_content);
            ?>
        </div>
        <?php
        $this->renderViews('masterlayout/footer');
        ?>
    </div>

    <script src="http://localhost/manageruser/app/public/plugins/jquery/jquery.min.js"></script>
    <script src="http://localhost/manageruser/app/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/manageruser/app/public/dist/js/adminlte.js"></script>
</body>

</html>