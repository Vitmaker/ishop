<?php defined('SHOP') or die('Access denied!');?>
<div id="right-bar">
    <div class="right-bar-cont">
        <div class="enter">
            <h2><span>Авторизация</span></h2>
            <style>
                label, .reglink{padding-left: 20px;}
                input{
                    margin: 0 0 15px 20px;
                    width: 170px;
                    height:20px;
                }
            </style>
            <div class="authform">
                <?php if(!$_SESSION['auth']['user']):?>
                        <form action="#" method="post">
                            <label for="login">Login:</label><br/>
                            <input type="text" name="login" id="login"/><br/>
                            <label for="pass">Password:</label><br/>
                            <input type="password" name="pass" id="pass"/><br/>
                            <input type="submit" name="auth" id="auth" value="Enter"/>
                            <a href="?view=reg" class="reglink">Registration</a>
                        </form>
                        <?php
                            if(isset($_SESSION['auth']['error'])){
                                echo '<div class="error">'.$_SESSION['auth']['error'].'</div>';
                                unset($_SESSION['auth']);
                            }
                        ?>
                <?php else:?>
                        <p>Добро пожаловать, <?=$_SESSION['auth']['user']?></p>
                        <a href="?do=logout">Выйти</a>
                <?php endif;?>
            </div>
        </div>
        <div class="basket">
            <h2><span>Корзина</span></h2>
            <div>
                <?php if($_SESSION['total_quantity']):?>
                    <p>Товаров в корзине:<br/>
                    <span><?=$_SESSION['total_quantity']?></span> шт. на <span><?=$_SESSION['total_sum']?></span> руб.</p>
                    <a href="#"><img src="<?=TEMPLATE?>images/oformit.jpg" alt="" /></a>
                <?php else:?>
                    <p>Корзина пуста</p>
                <?php endif;?>
            </div>
        </div>
        <div class="share-search">
            <h2><span>Выбор по параметрам</span></h2>
            <div>
                <form method="post" action="">
                    <p>Стоимость:</p>
                    от <input class="podbor-price" type="text" name="start-price" />
                    до <input class="podbor-price" type="text" name="end-price" />
                    руб.
                    <br /><br />
                    <p>Производители:</p>
                    <select>
                        <option>Ericsson</option>
                        <option>Alcatel</option>
                        <option>Mitsubish</option>
                        <option>Motorola</option>
                        <option>NEC</option>
                        <option>Nokia</option>
                    </select>
                    <input class="podbor" type="image" src="<?=TEMPLATE?>images/podbor.jpg" />
                </form>
            </div>
        </div>

    </div>
</div>