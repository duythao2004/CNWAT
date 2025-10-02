<h3><?= t('LOGIN_TITLE') ?></h3>
<form method="post" action="">
  <label><?= t('LOGIN_USER') ?> <input type="text" name="u"></label><br>
  <label><?= t('LOGIN_PASS') ?> <input type="password" name="p"></label><br>
  <label><input type="checkbox" name="r" value="1"> <?= t('LOGIN_REMEMBER') ?></label><br>
  <button class="btn" type="submit"><?= t('LOGIN_BUTTON') ?></button>
</form>

<?php
// Chỉ minh hoạ – không thật sự đăng nhập
if ($_SERVER['REQUEST_METHOD']==='POST') {
  echo '<p class="badge" style="margin-top:10px">Posted: '.htmlspecialchars($_POST['u'] ?? '').'</p>';
}
