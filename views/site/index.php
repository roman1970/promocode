<?php

/* @var $this yii\web\View */

$this->title = 'Приложение Промокод';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><a class="btn btn-default" href="https://drive.google.com/file/d/0B3mF2ZlF63jPSHlTMnc4cnB3N2s/view">Промокод (тестовое задание)</a></h1>
        <h2>1. Создать промокод</h2>
        <p><a class="btn btn-default" href="create">Создать</a></p>
        <h2>2-3. Просмотр кодов и редактирование</h2>
        <p><a class="btn btn-default" href="show">Просмотр и редактирование</a></p>
        <h2>4-5. API</h2>
        <p><a class="btn btn-default" href="http://servyz.xyz:8091/v1/promo">API все коды</a></p>
        <p><a class="btn btn-default" href="http://servyz.xyz:8091/v1/promo/get-discount-info?name=prom&fields=tar_zone,reward,begin_data,end_data,status">
                API вызов метода get_discount_info с параметром name=good_promo</a></p>
        <p><a class="btn btn-default" href="http://servyz.xyz:8091/v1/promo/activate-discount?name=prom&tar_zone=1">
                API вызов метода activate_discount с параметрами name=promocode_12&tar_zone=1</a></p>
    </div>

</div>
