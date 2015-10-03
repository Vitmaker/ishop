<?php
defined('SHOP') or die('Access denied!');

define('MODEL', 'model/model.php');
define('CONTROLLER', 'controller/controller.php');
define('VIEW', 'views/');
define('TEMPLATE', VIEW.'shop/');

define('HOST', 'localhost');
define('USER', 'founder');
define('PASS', '123456');
define('DB', 'ishop');

mysql_connect(HOST, USER, PASS) or die('No connect to server');
mysql_select_db(DB) or die('No connect to database');
mysql_query('SET NAMES utf8');