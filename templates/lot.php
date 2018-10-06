<section class="lot-item container">
  <h2><?=strip_tags($lot['name']);?></h2>
  <div class="lot-item__content">
    <div class="lot-item__left">
      <div class="lot-item__image">
        <img src="<?=$lot['image_url'];?>" width="730" height="548" alt="<?=$lot['category'];?>">
      </div>
      <p class="lot-item__category">Категория:
        <span><?=$lot['category'];?></span>
      </p>
      <p class="lot-item__description"><?=htmlspecialchars($lot['description']);?></p>
    </div>
    <div class="lot-item__right">
      <div class="lot-item__state">
        <div class="lot-item__timer timer"><?=$timer;?></div>
        <div class="lot-item__cost-state">
          <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost">
              <?=sum_format($bets[0]['summ'] ?? $lot['start_price']);?>
            </span>
          </div>
          <div class="lot-item__min-cost">Мин. ставка <span><?=$lot['bet_step'];?> р</span></div>
        </div>
        <?php if (isset($_SESSION['auth'])): ?>
            <form class="lot-item__form" action="add-bet.php" method="post">
                <p class="lot-item__form-item">
                    <label for="cost">Ваша ставка</label>
                    <input
                        id="cost"
                        type="number"
                        name="cost"
                        placeholder="<?=sum_format(($bets[0]['summ'] ?? $lot['start_price']) + $lot['bet_step']);?>"
                        <?php if (isset($answers['cost'])): ?>
                            value="<?=$answers['cost'];?>"
                        <?php endif;?>
                    >
                    <?php if (isset($errors['cost'])): ?>
                        <span class="form__error"><?=$errors['cost'];?></span>
                    <?php endif;?>
                </p>
                <button type="submit" class="button">Сделать ставку</button>
            </form>
        <?php endif;?>
      </div>
      <div class="history">
        <h3>История ставок <span><?=count($bets);?></span></h3>
        <table class="history__list">
        <?php foreach ($bets as $value): ?>
            <tr class="history__item">
                <td class="history__name"><?=$value['name'];?></td>
                <td class="history__price"><?=$value['summ'];?></td>
                <td class="history__time"><?=strftime('%d.%m.%y %H:%M', strtotime($value['date']));?></td>
            </tr>
        <?php endforeach;?>
        </table>
      </div>
    </div>
  </div>
</section>
