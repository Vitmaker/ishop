<?php
defined('SHOP') or die('Access denied!');

//CATALOG
function catalog(){
    $query = "SELECT * FROM brands ORDER BY parent_id, brand_name";
    $res = mysql_query($query) or die(mysql_error());

    $cat = array();
    while($row = mysql_fetch_assoc($res)){
        if(!$row['parent_id']){
            $cat[$row['brand_id']][] = $row['brand_name'];
        }else{
            $cat[$row['parent_id']]['sub'][$row['brand_id']] = $row['brand_name'];
        }
    }
    return $cat;
}
//CATALOG

//INFORMERS
function informer(){
    $query = "SELECT * FROM links
              INNER JOIN informers ON links.parent_informer = informers.informer_id
              ORDER BY informer_position, links_position";
    $res = mysql_query($query) or die(mysql_error());

    $name = '';
    $informers = array();
    while($row = mysql_fetch_assoc($res)){
        if($row['informer_name'] != $name){
            $informers[$row['informer_id']][] = $row['informer_name'];
            $name = $row['informer_name'];
        }
        $informers[$row['parent_informer']]['sub'][$row['link_id']] = $row['link_name'];
    }
    return $informers;
}
//INFORMERS

//EYESTOPPERS
function eyestopper($eyestopper){
    $query = "SELECT goods_id, name, img, price FROM goods WHERE $eyestopper='1' AND visible='1'";
    $res = mysql_query($query) or die(mysql_error());

    $eyestoppers = array();
    while($row = mysql_fetch_assoc($res)){
        $eyestoppers[] = $row;
    }
    return $eyestoppers;
}
//EYESTOPPERS

//COUNT ROWS
function count_rows($category){
    $query = "SELECT COUNT(goods_id) as count_rows
              FROM goods
              WHERE goods_brandid='$category' AND visible='1'
              UNION
              SELECT COUNT(goods_id) as count_rows
              FROM goods WHERE goods_brandid IN
              (SELECT brand_id FROM brands WHERE parent_id='$category')AND visible='1'";
    $res = mysql_query($query) or die(mysql_error());

    while($row = mysql_fetch_assoc($res)){
        if($row['count_rows']) $count_rows = $row['count_rows'];
    }
    return $count_rows;
}
//COUNT ROWS

//PRODUCT
function product($category, $start_pos, $perpage){
    $query = "SELECT goods_id, name, img, anons, visible, hits, new, sale, price
              FROM goods
              WHERE goods_brandid='$category' AND visible='1'
              UNION
              SELECT goods_id, name, img, anons, visible, hits, new, sale, price
              FROM goods WHERE goods_brandid IN
              (SELECT brand_id FROM brands WHERE parent_id='$category')AND visible='1' LIMIT $start_pos, $perpage";
    $res = mysql_query($query) or die(mysql_error());

    $products = array();
    while($row = mysql_fetch_assoc($res)){
        $products[] = $row;
    }
    return $products;
}
//PRODUCT

//CART
function total_sum($goods){
    $total_sum = 0;
    $str_goods = implode(",", array_keys($goods));
    $query = "SELECT goods_id, name, price
              FROM goods
              WHERE goods_id IN($str_goods)";
    $res = mysql_query($query) or die(mysql_error());
    while($row = mysql_fetch_assoc($res)){
        $_SESSION['cart'][$row['goods_id']]['name'] = $row['name'];
        $_SESSION['cart'][$row['goods_id']]['price'] = $row['price'];
        $total_sum += $_SESSION['cart'][$row['goods_id']]['qty'] * $row['price'];
    }
    return $total_sum;
}
//CART

//REGISTRATION
function registration(){
    $error = '';

    $login = clear($_POST['login']);
    $pass = trim($_POST['pass']);
    $repass = trim($_POST['repass']);
    $name = clear($_POST['name']);
    $phone = clear($_POST['phone']);
    $email = clear($_POST['email']);
    $address = clear($_POST['address']);

    if(empty($login)) $error .= '<li>Вы не ввели логин.</li>';
    if(empty($pass)) $error .= '<li>Вы не ввели пароль.</li>';
    if(empty($repass)) $error .= '<li>Повторите пароль.</li>';
    if(empty($name)) $error .= '<li>Вы не ввели свое ФИО.</li>';
    if(empty($phone)) $error .= '<li>Вы не ввели номер телефона.</li>';
    if(empty($email)) $error .= '<li>Вы не ввели свой E-mail.</li>';
    if(empty($address)) $error .= '<li>Вы не ввели адрес доставки.</li>';

    if(empty($error)){
        if($pass == $repass){
            $query = "SELECT customer_id FROM customers WHERE login='$login' LIMIT 1";
            $res = mysql_query($query) or die(mysql_error());
            $row = mysql_num_rows($res);
            if($row){
                $_SESSION['reg']['res'] = "<div class='error'>Такой логин уже существует.</div>";
                $_SESSION['reg']['name'] = $name;
                $_SESSION['reg']['phone'] = $phone;
                $_SESSION['reg']['email'] = $email;
                $_SESSION['reg']['address'] = $address;
            } else{
                $pass = md5($pass);
                $query = "INSERT INTO customers (name, email, phone, address, login, password)
                        VALUES('$name','$email','$phone', '$address', '$login', '$pass')";
                $res = mysql_query($query) or die(mysql_error());
                if(mysql_affected_rows() > 0){
                    $_SESSION['reg']['res'] = "<div class='success'>Вы успешно зарегистрировались.</div>";
                    $_SESSION['auth']['user'] = $name;
                }
            }
        } else{
            $_SESSION['reg']['res'] = "<div class='error'>Пароли не совпадают.</div>";
            $_SESSION['reg']['login'] = $login;
            $_SESSION['reg']['name'] = $name;
            $_SESSION['reg']['phone'] = $phone;
            $_SESSION['reg']['email'] = $email;
            $_SESSION['reg']['address'] = $address;
        }
    } else{
        $_SESSION['reg']['res'] = "<div class='error'>Вы не заполнили обязательные поля: <ul> $error </ul></div>";
        $_SESSION['reg']['login'] = $login;
        $_SESSION['reg']['name'] = $name;
        $_SESSION['reg']['phone'] = $phone;
        $_SESSION['reg']['email'] = $email;
        $_SESSION['reg']['address'] = $address;
    }

}
//REGISTRATION

//AUTHORIZATION
function authorization(){
    $login = mysql_real_escape_string($_POST['login']);
    $pass = trim($_POST['pass']);

    if(empty($login) || empty($pass)){
        $_SESSION['auth']['error'] = "Поля логин/пароль не заполнены.";
    } else{
        $pass = md5($pass);
        $query = "SELECT name FROM customers WHERE login='$login' AND password='$pass' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());

        if(mysql_num_rows($res) == 1){
            $row = mysql_fetch_row($res);
            $_SESSION['auth']['user'] = $row[0];
        } else{
            $_SESSION['auth']['error'] = 'Введенные Вами данные неверны.';
        }
    }
}
//AUTHORIZATION





























