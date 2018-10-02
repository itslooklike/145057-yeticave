<form class="form form--add-lot container <?=count($errors) ? ' form--invalid' : ''?>" action="add-lot.php" method="post" enctype="multipart/form-data">
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <div class="form__item <?=isset($errors['lot-name']) ? ' form__item--invalid' : ''?>">
      <label for="lot-name">Наименование</label>
      <input
        id="lot-name"
        name="lot-name"
        type="text"
        placeholder="Введите наименование лота"
        <?php if (isset($answers['lot-name'])): ?>
          value="<?=$answers['lot-name'];?>"
        <?php endif;?>
      >
      <?php if (isset($errors['lot-name'])): ?>
        <span class="form__error"><?=$errors['lot-name'];?></span>
      <?php endif;?>
    </div>
    <div class="form__item <?=isset($errors['lot-category']) ? ' form__item--invalid' : ''?>">
      <label for="category">Категория</label>
      <select
        id="category"
        name="lot-category"
      >
        <option>Выберите категорию</option>

        <?php foreach ($menu_list as $value): ?>
          <option
            value="<?=$value['name'];?>"
            <?=isset($answers['lot-category']) && $answers['lot-category'] === $value['name'] ? 'selected' : ''?>
          ><?=$value['name'];?></option>
        <?php endforeach;?>

      </select>
      <?php if (isset($errors['lot-category'])): ?>
        <span class="form__error"><?=$errors['lot-category'];?></span>
      <?php endif;?>
    </div>
  </div>
  <div class="form__item form__item--wide <?=isset($errors['lot-message']) ? ' form__item--invalid' : ''?>">
    <label for="lot-message">Описание</label>
    <textarea
      id="lot-message"
      name="lot-message"
      placeholder="Напишите описание лота"
    ><?=$answers['lot-message'] ?? ''?></textarea>
    <?php if (isset($errors['lot-message'])): ?>
      <span class="form__error"><?=$errors['lot-message'];?></span>
    <?php endif;?>
  </div>
  <div class="form__item form__item--file">
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file <?=isset($errors['lot-file']) ? ' form__item--invalid' : ''?>">
      <input class="visually-hidden" type="file" id="photo2" value="" name="lot-file">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <?php if (isset($errors['lot-file'])): ?>
      <span class="form__error"><?=$errors['lot-file'];?></span>
    <?php endif;?>
  </div>
  <div class="form__container-three">
    <div class="form__item form__item--small <?=isset($errors['lot-rate']) ? ' form__item--invalid' : ''?>">
      <label for="lot-rate">Начальная цена</label>
      <input
        id="lot-rate"
        name="lot-rate"
        type="number"
        placeholder="0"
        <?php if (isset($answers['lot-rate'])): ?>
          value="<?=$answers['lot-rate'];?>"
        <?php endif;?>
      >
      <?php if (isset($errors['lot-rate'])): ?>
        <span class="form__error"><?=$errors['lot-rate'];?></span>
      <?php endif;?>
    </div>
    <div class="form__item form__item--small <?=isset($errors['lot-step']) ? ' form__item--invalid' : ''?>">
      <label for="lot-step">Шаг ставки</label>
      <input
        id="lot-step"
        name="lot-step"
        type="number"
        placeholder="0"
        <?php if (isset($answers['lot-step'])): ?>
          value="<?=$answers['lot-step'];?>"
        <?php endif;?>
      >
      <?php if (isset($errors['lot-step'])): ?>
        <span class="form__error"><?=$errors['lot-step'];?></span>
      <?php endif;?>
    </div>
    <div class="form__item <?=isset($errors['lot-date']) ? ' form__item--invalid' : ''?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input
        class="form__input-date"
        id="lot-date"
        name="lot-date"
        type="date"
        <?php if (isset($answers['lot-date'])): ?>
          value="<?=$answers['lot-date'];?>"
        <?php endif;?>
      >
      <?php if (isset($errors['lot-date'])): ?>
        <span class="form__error"><?=$errors['lot-date'];?></span>
      <?php endif;?>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
