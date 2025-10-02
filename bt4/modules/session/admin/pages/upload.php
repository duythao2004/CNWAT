<?php
$uploadDir = __DIR__ . '/../uploads';
$publicDir = 'bt4/modules/session/admin/uploads'; // để render link

if (!is_dir($uploadDir)) {
  @mkdir($uploadDir, 0775, true);
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['file']['name'])) {
  $name = basename($_FILES['file']['name']);
  $tmp  = $_FILES['file']['tmp_name'];

  // đơn giản: chấp nhận mọi loại, đổi tên tránh đè
  $target = $uploadDir . '/' . time() . '_' . preg_replace('/\s+/', '_', $name);
  if (move_uploaded_file($tmp, $target)) {
    $msg = 'Tải lên thành công!';
  } else {
    $msg = 'Tải lên thất bại!';
  }
}

$files = array_values(array_filter(
  @scandir($uploadDir) ?: [],
  fn($f) => $f !== '.' && $f !== '..'
));
?>
<h3>Admin • Upload</h3>
<?php if ($msg): ?><p class="badge"><?= htmlspecialchars($msg) ?></p><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="vstack gap-2">
  <input type="file" name="file" required>
  <button class="btn" type="submit">Upload</button>
</form>

<h4>Danh sách file</h4>
<ul>
  <?php foreach ($files as $f): ?>
    <li><a href="<?= $publicDir . '/' . rawurlencode($f) ?>" download><?= htmlspecialchars($f) ?></a></li>
  <?php endforeach; ?>
  <?php if (!$files): ?><li><em>Chưa có file</em></li><?php endif; ?>
</ul>
