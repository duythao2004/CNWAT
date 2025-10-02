<?php
$err = [];
$data = [
  'hoten' => $_POST['hoten'] ?? '',
  'lop'   => $_POST['lop'] ?? '',
  'm1'    => $_POST['m1'] ?? '',
  'm2'    => $_POST['m2'] ?? '',
  'm3'    => $_POST['m3'] ?? '',
];
$tong = '';

if (isset($_POST['ok'])) {
  foreach (['hoten','lop','m1','m2','m3'] as $k) {
    if ($data[$k] === '') $err[] = "Thiếu: $k";
  }
  foreach (['m1','m2','m3'] as $k) {
    if ($data[$k] !== '' && !is_numeric($data[$k])) $err[] = "$k phải là số";
  }
  if (!$err) {
    $tong = (float)$data['m1'] + (float)$data['m2'] + (float)$data['m3'];
  }
}
?>
<h3>Calculate 2 – Tổng điểm</h3>

<form method="post" action="bt4/index.php?p=getpost&page=calculate2" class="stack gap-2">
  <label>Họ và tên:
    <input name="hoten" value="<?= htmlspecialchars($data['hoten']) ?>">
  </label><br>
  <label>Lớp:
    <input name="lop" value="<?= htmlspecialchars($data['lop']) ?>">
  </label><br>
  <label>Điểm M1:
    <input name="m1" value="<?= htmlspecialchars($data['m1']) ?>">
  </label><br>
  <label>Điểm M2:
    <input name="m2" value="<?= htmlspecialchars($data['m2']) ?>">
  </label><br>
  <label>Điểm M3:
    <input name="m3" value="<?= htmlspecialchars($data['m3']) ?>">
  </label><br>
  <label>Tổng điểm:
    <input name="tong" value="<?= htmlspecialchars((string)$tong) ?>" readonly>
  </label><br>

  <div class="row gap-2">
    <button class="btn" name="ok" value="1">OK</button>
    <a class="btn" href="bt4/index.php?p=getpost&page=calculate2">Cancel</a>
  </div>
</form>

<?php if ($err): ?>
  <ul class="text-warn mt-2">
    <?php foreach ($err as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?>
  </ul>
<?php elseif ($tong !== ''): ?>
  <p class="mt-2"><strong>Tổng điểm:</strong> <?= htmlspecialchars((string)$tong) ?></p>
<?php endif; ?>
