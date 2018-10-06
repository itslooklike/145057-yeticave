<form
    class="form container <?=count($errors) ? ' form--invalid' : ''?>"
    action="login.php"
    method="post"
>
  <h2>Вход</h2>
  <div class="form__item <?=isset($errors['email']) ? ' form__item--invalid' : ''?>">
    <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input
        id="email"
        type="text"
        name="email"
        placeholder="Введите e-mail"
        <?php if (isset($answers['email'])): ?>
            value="<?=$answers['email'];?>"
        <?php endif;?>
    >
    <?php if (isset($errors['email'])): ?>
        <span class="form__error"><?=$errors['email'];?></span>
    <?php endif;?>
  </div>
  <div class="form__item form__item--last <?=isset($errors['password']) ? ' form__item--invalid' : ''?>">
    <label for="password">Пароль*</label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="Введите пароль"
    >
    <?php if (isset($errors['password'])): ?>
        <span class="form__error"><?=$errors['password'];?></span>
    <?php endif;?>
  </div>
  <button type="submit" class="button">Войти</button>
</form>
