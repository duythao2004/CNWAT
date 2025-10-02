<?php /* Trang Contact */ ?>
<h3><?= t('CONTACT_TITLE') ?></h3>
<form class="form" method="post" action="">
  <div class="grid-2">
    <label><?= t('F_USERNAME') ?> <input type="text" name="username"></label><br>
    <label><?= t('F_BIRTHDAY') ?> <input type="date" name="birthday"></label><br>
    <label><?= t('F_ADDRESS') ?> <input type="text" name="address"></label><br>
    <label><?= t('F_EMAIL') ?> <input type="email" name="email"></label><br>
    <label><?= t('F_PHONE') ?> <input type="tel" name="phone"></label><br>
    <label class="span-2"><?= t('F_COMMENT') ?><br>
      <textarea name="comment" rows="4" style="width:100%"></textarea>
    </label>
  </div>
  <div style="margin-top:8px">
    <button type="reset" class="btn"><?= t('BTN_RESET') ?></button>
    <button type="submit" class="btn"><?= t('BTN_SUBMIT') ?></button>
  </div>
</form>

<?php
// Demo xử lý POST nho nhỏ để bạn thấy form hoạt động
if ($_SERVER['REQUEST_METHOD']==='POST') {
  echo '<div class="badge" style="margin-top:10px">Form submitted!</div>';
}
