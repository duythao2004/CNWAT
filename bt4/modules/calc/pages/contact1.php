<?php
// xử lý cùng trang
$isPost = ($_SERVER['REQUEST_METHOD']==='POST');
$C = fn($k,$d='') => $_POST[$k] ?? $d;

$username = $C('username');
$gender   = $C('gender','male');
$address  = $C('address','HN');
$note     = $C('note');
$addrMap  = ['HN'=>'Ha Noi','HCM'=>'TP. HCM','HUE'=>'Hue','DN'=>'Da Nang'];
?>
<div class="gf-box">
  <h3>Form Liên hệ</h3>
  <form class="gf-form" method="post" action="bt4/index.php?p=getform&page=contact1">
    <div class="row">
      <label>Username:</label>
      <input name="username" value="<?= htmlspecialchars($username) ?>">
    </div>

    <div class="row">
      <label>Gender:</label>
      <label><input type="radio" name="gender" value="male"   <?= $gender==='male'?'checked':'' ?>> Male</label>
      &nbsp;
      <label><input type="radio" name="gender" value="female" <?= $gender==='female'?'checked':'' ?>> Female</label>
    </div>

    <div class="row">
      <label>Address:</label>
      <select name="address">
        <?php foreach ($addrMap as $k=>$v): ?>
          <option value="<?= $k ?>" <?= $address===$k?'selected':'' ?>><?= $v ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="row">
      <label>Note:</label>
      <textarea name="note" rows="3" cols="40"><?= htmlspecialchars($note) ?></textarea>
    </div>

    <div class="row">
      <label></label>
      <button class="btn" type="reset">Reset</button>
      <button class="btn" type="submit">Contact</button>
    </div>
  </form>

  <?php if ($isPost): ?>
    <div class="gf-result">
      <h4>Thông tin liên hệ</h4>
      <div style="display:grid;grid-template-columns:180px 1fr;gap:8px">
        <div><strong>Username:</strong></div><div><?= htmlspecialchars($username ?: '(chưa nhập)') ?></div>
        <div><strong>Gender:</strong></div><div><?= $gender==='male'?'Nam':'Nữ' ?></div>
        <div><strong>Address:</strong></div><div><?= $addrMap[$address] ?? $address ?></div>
        <div><strong>Note:</strong></div><div><?= nl2br(htmlspecialchars($note)) ?></div>
      </div>
    </div>
  <?php endif; ?>
</div>
