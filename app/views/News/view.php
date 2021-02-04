<?if(!empty($oneNews)):?>
    <div class="title">
        <h2><?=$oneNews['title']?></h2>
    </div>
    <div class="row">
        <div class="date">Дата добавления: <?=$oneNews['date']?></div>
        <img src="<?=$oneNews['image']?>" alt="" />
        <p>
            <?=$oneNews['text']?>
        </p>

    </div>
<?else:?>
    <p>Такой новости не существует</p>
<?endif;?>
