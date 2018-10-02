<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">

    <?php foreach ($menu_list as $value): ?>
        <li class="promo__item promo__item--boards">
            <a class="promo__link" href="all-lots.html"><?=$value['name'];?></a>
        </li>
    <?php endforeach;?>

    </ul>
</section>

<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">

    <?php foreach ($lots_list as $value): ?>
        <?=include_template('_item-list.php', $value);?>
    <?php endforeach;?>

    </ul>
</section>
