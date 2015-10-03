<div class="catalog-index">
    <div class="kroshka">
        <a href="#">Мобильные телефоны</a> / <a href="#">LG</a> / <span>Слайдеры</span>
    </div>
    <div class="vid-sort">
        Вид:
        <a href="#" id="grid" class="grid_list"><img src="<?=TEMPLATE?>images/vid-tabl.gif" title="табличный вид" alt="табличный вид" /></a>
        <a href="#" id="list" class="grid_list"><img src="<?=TEMPLATE?>images/vid-line.gif" alt="табличный вид" /></a>
        &nbsp;&nbsp;
        Сортировать по:&nbsp;
        <a href="#" class="sort-bot-act">цене</a>  &nbsp;|&nbsp;
        <a href="#" class="sort-bot">названию</a>  &nbsp;|&nbsp;
        <a href="#" class="sort-bot">добавлению</a>
    </div>
    <?php if($products):?>
        <?php foreach($products as $product):?>
            <?php if(!isset($_COOKIE['display']) || $_COOKIE['display'] == 'grid'):?>
                <div class="product-table">
                    <h2><a href="?view=product&good_id=<?=$product['goods_id']?>"><?=$product['name']?></a></h2>
                    <div class="product-table-img-main">
                        <div class="product-table-img">
                            <a href="?view=product&good_id=<?=$product['goods_id']?>"><img src="<?=TEMPLATE?>images/<?=$product['img']?>" alt="<?=$product['name']?>" width="64"/></a>
                            <div>
                                <?php if($product['hits']) echo '<img src="'.TEMPLATE.'images/ico-cat-lider.png" alt="Лидер продаж" />'; ?>
                                <?php if($product['new']) echo '<img src="'.TEMPLATE.'images/ico-cat-new.png" alt="Новинка" />'; ?>
                                <?php if($product['sale']) echo '<img src="'.TEMPLATE.'images/ico-cat-sale.png" alt="Скидка" />'; ?>
                            </div>
                        </div>
                    </div>
                    <p class="cat-table-more"><a href="?view=product&good_id=<?=$product['goods_id']?>">подробнее...</a></p>
                    <p>Цена :  <span><?=$product['price']?></span></p>
                    <a href="?view=addtocart&goods_id=<?=$product['goods_id']?>"><img class="addtocard-index" src="<?=TEMPLATE?>images/addcard-table.jpg" alt="Добавить в карзину" /></a>
                </div>
            <?php else:?>
                <div class="product-line">
                    <div class="product-line-img">
                        <a href="?view=product&good_id=<?=$product['goods_id']?>"><img src="<?=TEMPLATE?>images/<?=$product['img']?>" alt="" width="56"/></a>
                    </div>
                    <div class="product-line-price">
                        <p>Цена :  <span><?=$product['price']?></span></p>
                        <a href="?view=addtocart&goods_id=<?=$product['goods_id']?>"><img class="addtocard-index" src="<?=TEMPLATE?>images/addcard-table.jpg" alt="Добавить в карзину" /></a>
                        <div>
                            <?php if($product['hits']) echo '<img src="'.TEMPLATE.'images/ico-cat-lider.png" alt="Лидер продаж" />'; ?>
                            <?php if($product['new']) echo '<img src="'.TEMPLATE.'images/ico-cat-new.png" alt="Новинка" />'; ?>
                            <?php if($product['sale']) echo '<img src="'.TEMPLATE.'images/ico-cat-sale.png" alt="Скидка" />'; ?>
                        </div>
                        <p class="cat-line-more"><a href="#">подробнее...</a></p>
                    </div>
                    <div class="product-line-opis">
                        <h2><a href="?view=product&good_id=<?=$product['goods_id']?>"><?=$product['name']?></a></h2>
                        <p><?=$product['anons']?></p>
                    </div>
                </div>
            <?php endif;?>
        <?php endforeach;?>
        <?php pagination($page, $pages_count);?>
    <?php else:?>
        <p>Здесь товаров нет!</p>
    <?php endif;?>


    <div class="clr"></div>
<!--    <div class="pager">-->
<!--        <a href="#"><img src="--><?//=TEMPLATE?><!--images/pager-prev.jpg" alt="назад" /></a>-->
<!--        1-->
<!--        <a href="#">2</a>-->
<!--        <a href="#">3</a>-->
<!--        <a href="#">4</a>-->
<!--        <a href="#">5</a>-->
<!--        <a href="#">...</a>-->
<!--        <a href="#">27</a>-->
<!--        <a href="#"><img src="--><?//=TEMPLATE?><!--images/pager-next.jpg" alt="вперед" /></a>-->
<!--    </div>-->

</div>