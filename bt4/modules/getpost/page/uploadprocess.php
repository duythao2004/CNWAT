<?php
$destFs = dirname(__DIR__, 2) . '/uploads';     // đường dẫn thật: bt4/uploads
$destUrl = 'bt4/uploads/';                      // đường dẫn URL (base đã là /CNWAT/)
if (!is_dir($destFs)) mkdir($destFs, 0777, true);

$links = [];
if (!empty($_FILES['files']['name']) && is_array($_FILES['files']['name'])) {
  foreach ($_FILES['files']['name'] as $i => $name) {
    if (!$name) continue;
    $tmp  = $_FILES['files']['tmp_name'][$i];
    $safe = preg_replace('/[^A-Za-z0-9_.-]+/', '_', $name); // đơn giản hoá tên
    $path = $destFs . '/' . $safe;
    if (is_uploaded_file($tmp) && move_uploaded_file($tmp, $path)) {
      $links[] = $destUrl . $safe;
    }
  }
}
?>
<h3>Kết quả upload</h3>
<?php if ($links): ?>
  <ul>
    <?php foreach ($links as $url): ?>
      <li><a href="<?= htmlspecialchars($url) ?>" target="_blank">Download: <?= htmlspecialchars(basename($url)) ?></a></li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Không có tệp nào được tải lên.</p>
<?php endif; ?>

<p class="mt-2"><a class="btn" href="bt4/index.php?p=getpost&page=array2">Quay lại Upload</a></p>
