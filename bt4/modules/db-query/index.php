<?php
// Router của module “Truy vấn dữ liệu”
$PAGE = $_GET['page'] ?? 'home';
$base = __DIR__;

require_once $base.'/libs/db.php';

$tabs = [
  'home' => 'Home',
];

$file = $base.'/pages/'.$PAGE.'.php';
if (!is_file($file)) $file = $base.'/pages/home.php';
?>
<section class="inner-hero card">
  <nav class="chips">
    <?php foreach ($tabs as $k=>$label): ?>
      <a class="chip <?= $PAGE===$k?'active':'' ?>"
         href="bt4/index.php?p=db-query&page=<?= $k ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<section class="card">
  <?php include $file; ?>
</section>
