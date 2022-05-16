<?php
    session_start();
    require_once 'admin/config.php';
    require_once 'incfiles/functions.php';
    $fileCurrent = str_replace('/', '', $_SERVER['SCRIPT_NAME']);
    switch($fileCurrent){
        case 'login.php':
        case 'register.php':
        case 'forgotpassword.php':
        case 'recovery-password.php':
            if(isset($_SESSION['user'])){
                header('Location: '.DOMAIN.'/trang-chu.html');
            }
        break;
        case 'profile.php':
        case 'change-password.php':
        case 'order.php':
        case 'order-detail.php':
            if(!isset($_SESSION['user'])){
                header('Location: '.DOMAIN.'/trang-chu.html');
            }
        break;
    }
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=WEBSITE_NAME?></title>
    <link rel="icon" href="https://icon-library.com/images/letter-n-icon/letter-n-icon-15.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?=DOMAIN?>/assets/css/main.css?random=<?=randomStr()?>">
</head>
<body id="style-5">
    <header>
        <div class="form-search">
            <div class="container-custom">
                <form class="search" action="<?=DOMAIN?>/danh-sach-san-pham/">
                    <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm...">
                    <button><i class="fas fa-search"></i> Tìm kiếm</button>
                    <span class="close-form"><i class="fas fa-times"></i> Đóng</span>
                </form>
            </div>
        </div>
        <div class="container-custom header">
            <a href="<?=DOMAIN?>/index.php"><img class="logo" src="<?=DOMAIN?>/assets/img/logo/<?=WEBSITE_LOGO?>"></a>
            <nav>
                <label for="menu-mobile"><i class="fas fa-align-justify"></i></label>
                <input type="checkbox" id="menu-mobile" hidden>
                <ul>
                    <li><a href="<?=DOMAIN?>/trang-chu.html">Trang chủ</a></li>
                    <li class="dropdown"><a href="<?=DOMAIN?>/danh-sach-san-pham/">Sản Phẩm</a>
                        <ul class="dropdown-list">
                            <?php
                            $listCategory   = getQueryValue("SELECT * FROM categories WHERE cat_active = 1");
                            foreach($listCategory as $category): ?>
                            <li><a href="<?=DOMAIN?>/danh-sach-san-pham/?category%5B%5D=<?=$category['cat_id']?>"><?=$category['cat_name']?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <li><a href="<?=DOMAIN?>/gioi-thieu/">Giới Thiệu</a></li>
                    <li><a href="<?=DOMAIN?>/lien-he/">Liên hệ</a></li>
                </ul>
            </nav>
            <ul class="header-action">
                <li class="icon-search"><i class="fas fa-search"></i></li>
                <li class="dropdown"><i class="far fa-user"></i> <span style="font-size: 0.9rem"><?=$_SESSION['user']['fullname'] ?? ''?></span>
                    <ul class="dropdown-list">
                        <?php if(!isset($_SESSION['user'])){ ?>
                            <li><a href="<?=DOMAIN?>/dang-nhap/">Đăng nhập</a></li>
                            <li><a href="<?=DOMAIN?>/dang-ky/">Đăng kí</a></li>
                        <?php } else { ?>
                            <?php if($_SESSION['user']['permission'] == 2){ ?>
                                <li><a href="<?=DOMAIN?>/admin">Quản lý cửa hàng</a></li>
                            <?php } ?>
                            <li><a href="<?=DOMAIN?>/don-hang/">Đơn hàng</a></li>
                            <li><a href="<?=DOMAIN?>/tai-khoan/">Tài khoản của tôi</a></li>
                            <li><a href="<?=DOMAIN?>/doi-mat-khau/">Đổi mật khẩu</a></li>
                            <li><a href="<?=DOMAIN?>/dang-xuat/">Đăng xuất</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="cart"><i class="fas fa-shopping-cart"></i>
                    <div class="cart-list">
                        <div class="cart-list__body" id="style-5">     </div>
                        <div class="cart-list__footer">
                            <div class="cart-list__total-price">
                                <span>Tổng tiền: </span>
                                <span>0đ</span>
                            </div>
                            <div class="cart-list__button">
                                <a href="<?=DOMAIN?>/gio-hang/"><button class="cart-list__btn">xem giỏ hàng</button></a>
                                <a href="<?=DOMAIN?>/thanh-toan/"><button class="cart-list__btn">thanh toán</button></a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>