<?php
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user']['permission'] != 2){
        header('Location: logout.php');
    }
    require_once 'config.php';
    require_once '../incfiles/functions.php';
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user']['id'];
        $query  = "SELECT * FROM users WHERE user_id = $userID";
        if(issetRecordQuery($query)){
            $user = getQueryValueRecord($query);
            $_SESSION['user']['fullname']   = $user['fullname'];
            $_SESSION['user']['permission'] = $user['permission'];
            $_SESSION['user']['avatar']     = $user['avatar'];
            if($user['active'] == 0){
                session_destroy();
            }
        } else {
            session_destroy();
        }
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dự Án Mẫu | Nguyễn Đăng Nhật</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/all.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <!-- c3 Charts -->
    <link href="css/plugins/c3/c3.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
<!-- <div id="loading">
  <img id="loading-image" src="https://cdn.dribbble.com/users/172519/screenshots/3520576/dribbble-spinner-800x600.gif" alt="Loading..." />
</div> -->
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="../../assets/img/avatar/<?=$_SESSION['user']['avatar']?>" style="width:48px;height:48px" />
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><? echo $_SESSION['user']['fullname'] ?></span>
                            <span class="text-muted text-xs block">FPT Polytechnic <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Trang cá nhân</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                    N+
                    </div>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-th-large"></i> <span class="nav-label">Trang chủ</span></a>
                </li>
                <!-- <li>
                    <a href="category.php"><i class="fas fa-archive"></i> <span class="nav-label">Danh mục sản phẩm</span></a>
                </li>
                <li>
                    <a href="list-product.php"><i class="fas fa-tshirt"></i> <span class="nav-label">Quản lý sản phẩm</span></a>
                </li>
                <li>
                    <a href="add-product.php"><i class="fas fa-plus"></i> <span class="nav-label">Thêm sản phẩm</span></a>
                </li> -->
                <li class="">
                    <a href="#" aria-expanded="false"><i class="fas fa-tshirt"></i> <span class="nav-label">Sản phẩm</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="category.php">Danh mục sản phẩm</a></li>
                        <li><a href="stats-categories.php">Thống kê danh mục</a></li>
                        <li><a href="list-product.php">Quản lý sản phẩm</a></li>
                        <li><a href="add-product.php">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#" aria-expanded="false"><i class="far fa-images"></i> <span class="nav-label">Slide</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="slides.php">Quản lý slide</a></li>
                        <li><a href="add-slide.php">Thêm slide</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#" aria-expanded="false"><i class="fas fa-users-cog"></i> <span class="nav-label">Người dùng</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="list-user.php">Quản lý người dùng</a></li>
                        <li><a href="add-user.php">Thêm người dùng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="list-comment.php"><i class="fas fa-comment-dots"></i> <span class="nav-label">Quản Lý Bình Luận</span></a>
                </li>
                <li>
                    <a href="list-order.php"><i class="fas fa-shopping-basket"></i> <span class="nav-label">Quản Lý Đơn Hàng</span></a>
                </li>
                <li class="">
                    <a href="#" aria-expanded="false"><i class="fas fa-user-cog"></i> <span class="nav-label">Tài khoản</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="profile.php">Thông tin tài khoản</a></li>
                        <li><a href="change-password.php">Đổi mật khẩu</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="slides.php"><i class="far fa-images"></i> <span class="nav-label">Quản lý slide</span></a>
                </li>
                <li>
                    <a href="add-slide.php"><i class="far fa-image"></i> <span class="nav-label">Thêm slide</span></a>
                </li> -->
                <li>
                    <a href="settings.php"><i class="fas fa-cogs"></i> <span class="nav-label">Cài đặt website</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span class="nav-label">Đăng xuất</span></a>
                </li>
                <li>
                    <a href="<?=DOMAIN?>/trang-chu.html" target="_blank"><i class="fas fa-house-damage"></i> <span class="nav-label">Xem cửa hàng</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Nhập để tìm kiếm..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Xin chào</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="#">
                                    <img alt="image" class="rounded-circle" src="<?=DOMAIN?>/assets/img/avatar/<?=$_SESSION['user']['avatar']?>">
                                </a>
                                <div>
                                    <small class="float-right">46 giờ trước</small>
                                    <strong>Nguyễn Đăng Nhật</strong> bắt đầu theo dõi <strong>Nguyễn Đăng Nhật</strong>. <br>
                                    <small class="text-muted">46 giờ trước lúc 7:58 pm - 26.07.2021</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Xem tất cả tin nhắn</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Bạn có 8 tin nhắn
                                    <span class="float-right text-muted small">4 phút trước</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#" class="dropdown-item">
                                    <strong>See tất cả</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </li>
            </ul>

        </nav>
        </div>