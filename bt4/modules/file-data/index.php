<?php
// bt4/modules/file-data/index.php
$PAGE = $_GET['page'] ?? 'list';

$tabs = [
  'list' => 'Danh sách',
  'add'  => 'Thêm mới',
];

$base = __DIR__;
require_once $base.'/libs/data.php';         // nạp hàm đọc/ghi

$file = $base.'/pages/'.$PAGE.'.php';
if (!is_file($file)) $file = $base.'/pages/list.php';
?>
<section class="inner-hero card">
  <nav class="chips" aria-label="File & Data flow">
    <?php foreach ($tabs as $k => $label): ?>
      <a class="chip <?= $PAGE===$k?'active':'' ?>"
         href="bt4/index.php?p=file-data&page=<?= $k ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<section class="card">
  <?php include $file; ?>
</section>
