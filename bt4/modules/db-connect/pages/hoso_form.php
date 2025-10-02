<?php
$isEdit = ($_GET['op'] ?? '') === 'edit';
$pk = $_GET['id'] ?? '';

$data = [
  'MAHS'=>'','HOTEN'=>'','NGAYSINH'=>'','DIACHI'=>'',
  'LOP'=>'','DIEMTOAN'=>'','DIEMLY'=>'','DIEMHOA'=>''
];

if ($isEdit) {
  $stmt = db()->prepare("SELECT * FROM HOSO WHERE MAHS=?");
  $stmt->execute([$pk]);
  $data = $stmt->fetch() ?: $data;
}

// lấy danh sách LOP cho select
$lop = db()->query("SELECT MALOP, TENLOP FROM LOP ORDER BY MALOP")->fetchAll();

// Submit
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $MAHS = trim(param('MAHS'));
  $HOTEN = trim(param('HOTEN'));
  $NGAYSINH = param('NGAYSINH');
  $DIACHI = trim(param('DIACHI'));
  $LOP = trim(param('LOP'));
  $DIEMTOAN = param('DIEMTOAN')!=='' ? (float)param('DIEMTOAN') : null;
  $DIEMLY   = param('DIEMLY')  !=='' ? (float)param('DIEMLY')   : null;
  $DIEMHOA  = param('DIEMHOA') !=='' ? (float)param('DIEMHOA')  : null;

  if ($isEdit) {
    $sql = "UPDATE HOSO SET HOTEN=?, NGAYSINH=?, DIACHI=?, LOP=?, DIEMTOAN=?, DIEMLY=?, DIEMHOA=? WHERE MAHS=?";
    db()->prepare($sql)->execute([$HOTEN,$NGAYSINH,$DIACHI,$LOP,$DIEMTOAN,$DIEMLY,$DIEMHOA,$MAHS]);
  } else {
    $sql = "INSERT INTO HOSO(MAHS,HOTEN,NGAYSINH,DIACHI,LOP,DIEMTOAN,DIEMLY,DIEMHOA)
            VALUES(?,?,?,?,?,?,?,?)";
    db()->prepare($sql)->execute([$MAHS,$HOTEN,$NGAYSINH,$DIACHI,$LOP,$DIEMTOAN,$DIEMLY,$DIEMHOA]);
  }
  redirect('index.php?p=db-connect&tab=hoso');
}
?>
<h3><?= $isEdit?'Sửa HOSO':'Thêm HOSO' ?></h3>
<form method="post" class="form">
  <label>Mã HS (8): <input name="MAHS" value="<?= h($data['MAHS']) ?>" maxlength="8" <?= $isEdit?'readonly':'' ?> required></label><br>
  <label>Họ tên: <input name="HOTEN" value="<?= h($data['HOTEN']) ?>" required></label><br>
  <label>Ngày sinh: <input type="date" name="NGAYSINH" value="<?= h($data['NGAYSINH']) ?>" required></label><br>
  <label>Địa chỉ: <input name="DIACHI" value="<?= h($data['DIACHI']) ?>" required></label><br>
  <label>Lớp:
    <select name="LOP" required>
      <option value="">-- chọn lớp --</option>
      <?php foreach ($lop as $l): ?>
        <option value="<?= h($l['MALOP']) ?>" <?= $l['MALOP']===$data['LOP']?'selected':'' ?>>
          <?= h($l['MALOP'].' - '.$l['TENLOP']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label><br>
  <div class="grid-3">
    <label>Toán: <input type="number" step="0.01" name="DIEMTOAN" value="<?= h($data['DIEMTOAN']) ?>"></label>
    <label>Lý:   <input type="number" step="0.01" name="DIEMLY"   value="<?= h($data['DIEMLY']) ?>"></label>
    <label>Hóa:  <input type="number" step="0.01" name="DIEMHOA"  value="<?= h($data['DIEMHOA']) ?>"></label>
  </div>
  <button class="btn">Lưu</button>
  <a class="btn" href="bt4/index.php?p=db-connect&tab=hoso">Hủy</a>
</form>
