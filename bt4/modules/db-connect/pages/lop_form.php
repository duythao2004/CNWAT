<?php
$isEdit = ($_GET['op'] ?? '') === 'edit';
$pk = $_GET['id'] ?? '';

$data = ['MALOP'=>'','TENLOP'=>'','KHOAHOC'=>'','GVCN'=>''];
if ($isEdit) {
  $stmt = db()->prepare("SELECT * FROM LOP WHERE MALOP=?");
  $stmt->execute([$pk]);
  $data = $stmt->fetch() ?: $data;
}

// Submit
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $malop   = trim(param('MALOP'));
  $tenlop  = trim(param('TENLOP'));
  $khoahoc = (int)param('KHOAHOC');
  $gvcn    = trim(param('GVCN'));

  if ($isEdit) {
    $stmt = db()->prepare("UPDATE LOP SET TENLOP=?, KHOAHOC=?, GVCN=? WHERE MALOP=?");
    $stmt->execute([$tenlop,$khoahoc,$gvcn,$malop]);
  } else {
    $stmt = db()->prepare("INSERT INTO LOP(MALOP,TENLOP,KHOAHOC,GVCN) VALUES(?,?,?,?)");
    $stmt->execute([$malop,$tenlop,$khoahoc,$gvcn]);
  }
  redirect('index.php?p=db-connect&tab=lop');
}
?>
<h3><?= $isEdit?'Sửa LOP':'Thêm LOP' ?></h3>
<form method="post" class="form">
  <label>Mã lớp (6): <input name="MALOP" value="<?= h($data['MALOP']) ?>" maxlength="6" <?= $isEdit?'readonly':'' ?> required></label><br>
  <label>Tên lớp: <input name="TENLOP" value="<?= h($data['TENLOP']) ?>" required></label><br>
  <label>Khóa học: <input type="number" name="KHOAHOC" value="<?= h($data['KHOAHOC']) ?>" required></label><br>
  <label>GVCN: <input name="GVCN" value="<?= h($data['GVCN']) ?>" required></label><br>
  <button type="submit" class="btn">Lưu</button>
  <a class="btn" href="/CNWAT/bt4/index.php?p=db-connect&tab=hoso">Hủy</a>
</form>
