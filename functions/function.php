<?php
defined('SHOP') or die('Access denied!');

//Tree of array
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

//Clear string from virus
function clear($string){
    $string = mysql_real_escape_string(strip_tags(trim($string)));
    return $string;
}

// Redirect
function redirect(){
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['HTTP_HOST'];
    header("Location: $redirect");
    exit;
}

// Logout
function logout(){
    unset($_SESSION['auth']);
}

// Add to cart
function addtocart($goods_id){
    if(isset($_SESSION['cart'][$goods_id])){
        $_SESSION['cart'][$goods_id]['qty'] += 1;
        return $_SESSION['cart'];
    } else{
        $_SESSION['cart'][$goods_id]['qty'] = 1;
        return $_SESSION['cart'];
    }
}

//Pagination


// <<  <  1 | 2 | 3 | 4 | 5 | 6  >  >>