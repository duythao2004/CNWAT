<?php
// ĐƯỜNG DẪN FILE
$dataDir = __DIR__ . '/../data';
$file = $dataDir . '/student.txt';
if (!is_dir($dataDir)) mkdir($dataDir, 0777, true);

$msg = '';
// ====== SERVER LOGIC ======
// Khi POST, kiểm tra & ghi nối tiếp 3 dòng vào student.txt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ten  = trim($_POST['ten']  ?? '');
  $dia  = trim($_POST['dia']  ?? '');
  $tuoi = trim($_POST['tuoi'] ?? '');
  if ($ten === '' || $dia === '' || $tuoi === '') {
    $msg = '<div class="badge danger">Vui lòng nhập đủ Tên/Địa chỉ/Tuổi.</div>';
  } elseif (!ctype_digit($tuoi)) {
    $msg = '<div class="badge danger">Tuổi phải là số nguyên.</div>';
  } else {
    // Ghi an toàn (LOCK_EX). Dùng 3 dòng cho đúng yêu cầu trong PDF.
    $payload = $ten . PHP_EOL . $dia . PHP_EOL . $tuoi . PHP_EOL;
    file_put_contents($file, $payload, FILE_APPEND | LOCK_EX);
    $msg = '<div class="badge success">Đã ghi vào file.</div>';
  }
}
?>
<h3>Thêm sinh viên mới</h3>
<?= $msg ?>
<form method="post" class="vstack gap-2" style="max-width:500px">
  <label>Ten:<input class="input" name="ten"  required></label><br>
  <label>Dia chi:<input class="input" name="dia"  required></label><br>
  <label>Tuoi:<input class="input" name="tuoi" required></label><br>
  <div class="hstack gap-2">
    <button type="reset" class="btn">Nhập lại</button>
    <button class="btn primary">Ghi</button>
  </div>
</form>
