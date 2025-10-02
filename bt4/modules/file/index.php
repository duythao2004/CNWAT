<?php
// bt4/modules/file/index.php
// Router module 4.9 – Đọc/ghi file (GET: ?p=file&page=xxx)
$PAGE = $_GET['page'] ?? 'home';
$base = __DIR__;

$tabs = [
  'home'   => 'Home',
  'list'   => 'Danh sách',
  'add'    => 'Thêm mới',
  'gmail'  => 'Gmail mock',
  'yahoo'  => 'Yahoo mock',
];

$file = "$base/pages/$PAGE.php";
if (!is_file($file)) $file = "$base/pages/home.php";
?>
<section class="inner-hero card">
  <nav class="chips" aria-label="File I/O">
    <?php foreach ($tabs as $k => $label): ?>
      <a class="chip <?= $PAGE===$k?'active':'' ?>"
         href="bt4/index.php?p=file&page=<?= $k ?>"><?= htmlspecialchars($label) ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<section class="card">
  <?php include $file; ?>
</section>
