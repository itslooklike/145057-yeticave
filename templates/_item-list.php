<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?=$image_url;?>" width="350" height="260" alt="Сноуборд">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?=$category;?></span>
        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$id;?>"><?=$title;?></a></h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?=sum_format($start_price);?></span>
            </div>
            <div class="lot__timer timer"><?=$timer;?></div>
        </div>
    </div>
</li>
