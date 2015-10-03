<?php
defined('SHOP') or die('Access denied!');

session_start();

require_once MODEL;

require_once 'functions/function.php';

$cat = catalog();

$informers = informer();

$view = empty($_GET['view']) ? 'hits' : $_GET['view'];

if($_POST['reg']){
    registration();
    redirect();
}

if($_POST['auth']){
    authorization();
    if($_SESSION['auth']['user']){
        echo "<p>Добро пожаловать, {$_SESSION['auth']['user']}</p>";
        exit;
    } else{
        echo $_SESSION['auth']['error'];
        unset($_SESSION['auth']);
        exit;
    }
}

if($_GET['do'] == 'logout'){
    logout();
    redirect();
}

switch($view){
    case('hits'):
        $eyestoppers = eyestopper($view);
    break;

    case('new'):
        $eyestoppers = eyestopper($view);
    break;

    case('sale'):
        $eyestoppers = eyestopper($view);
    break;

    case('cat'):
        $category = abs((int)$_GET['category']);

        $perpage= 6;
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        } else{
            $page = 1;
        }

        $count_rows = count_rows($category); //common amount product
        $pages_count = ceil($count_rows / $perpage); // common amount pages
        if(!$pages_count) $pages_count = 1;
        if($page > $pages_count) $page = $pages_count;
        $start_pos = ($page - 1) * $perpage;

        $products = product($category, $start_pos, $perpage);
    break;

    case('addtocart'):
        $goods_id = abs((int)$_GET['goods_id']);
        addtocart($goods_id);

        $_SESSION['total_sum'] = total_sum($_SESSION['cart']);
        $_SESSION['total_quantity'] = 0;
        foreach($_SESSION['cart'] as $key => $value){
            if(isset($value['price'])){
                $_SESSION['total_quantity'] += $value['qty'];
            } else{
                unset($_SESSION['cart'][$key]);
            }
        }
        redirect();
    break;

    case('reg'):

    break;

    default:
        $view = 'hits';
        $eyestoppers = eyestopper($view);
}

require_once TEMPLATE.'index.php';