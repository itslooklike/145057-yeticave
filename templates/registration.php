<form
    class="form container <?=count($errors) ? ' form--invalid' : ''?>"
    action="registration.php"
    method="post"
    enctype="multipart/form-data"
    >
  <h2>Регистрация нового аккаунта</h2>
  <div class="form__item <?=isset($errors['email']) ? ' form__item--invalid' : ''?>">
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail">
    <?php if (isset($errors['email'])): ?>
        <span class="form__error"><?=$errors['email'];?></span>
    <?php endif;?>
  </div>
  <div class="form__item <?=isset($errors['password']) ? ' form__item--invalid' : ''?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль">
    <?php if (isset($errors['password'])): ?>
        <span class="form__error"><?=$errors['password'];?></span>
    <?php endif;?>
  </div>
  <div class="form__item <?=isset($errors['name']) ? ' form__item--invalid' : ''?>">
    <label for="name">Имя*</label>
    <input
    id="name"
    type="text"
    name="name"
    placeholder="Введите имя"
    <?php if (isset($answers['name'])): ?>
        value="<?=$answers['name'];?>"
    <?php endif;?>
    >
    <?php if (isset($errors['name'])): ?>
        <span class="form__error"><?=$errors['name'];?></span>
    <?php endif;?>
  </div>
  <div class="form__item <?=isset($errors['message']) ? ' form__item--invalid' : ''?>">
    <label for="message">Контактные данные*</label>
    <textarea
        id="message"
        name="message"
        placeholder="Напишите как с вами связаться"
    ><?php if (isset($answers['message'])): ?><?=$answers['message'];?><?php endif;?></textarea>
    <?php if (isset($errors['message'])): ?>
        <span class="form__error"><?=$errors['message'];?></span>
    <?php endif;?>
  </div>
  <div class="form__item form__item--file form__item--last">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/user-avatar-placeholder.svg" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file <?=isset($errors['avatar']) ? ' form__item--invalid' : ''?>">
      <input class="visually-hidden" type="file" id="photo2" value="" name="avatar">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <?php if (isset($errors['avatar'])): ?>
        <span class="form__error"><?=$errors['avatar'];?></span>
    <?php endif;?>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
