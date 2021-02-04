<?php
//pr($news);
?>

<div class="title">
    <h2>Nulla luctus eleifend purus</h2>
    <p>This is <strong>TailPiece</strong>, a free, fully standards-compliant CSS template designed by <a
                href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a
                href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a
                href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free
        to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
</div>

<?
$c = 1;
?>

<div class="boxA">
    <? foreach ($news as $arNews): ?>

        <div class="box margin-btm">
            <img src="<?= $arNews['image'] ?>" width="320" alt=""/>
            <div class="details">
                <p><?= $arNews['preview'] ?></p>
            </div>
            <a href="news/view/<?= $arNews['id'] ?>" class="button">More Details</a>
        </div>

        <? if ($c % 2 == 0): ?>
            </div><div class="boxA">
        <? endif; ?>

    <? $c++; ?>

    <? endforeach; ?>
</div>
