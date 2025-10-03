<?php
// Router nội bộ cho phần End-user shop
$act = $_GET['act'] ?? 'home';

$base = __DIR__;
require_once $base . '/libs/db.php';

// Tabs ngang (giống style chips của bạn)
$tabs = [
  'home'   => 'Trang chủ',
];

$pageFile = $base . '/pages/home.php';
if ($act === 'list')   $pageFile = $base . '/pages/list.php';
if ($act === 'detail') $pageFile = $base . '/pages/detail.php';
if ($act === 'search') $pageFile = $base . '/pages/search.php';
?>
<section class="inner-hero card">
  <nav class="chips">
    <?php foreach ($tabs as $k=>$label): ?>
      <a class="chip <?= $act===$k?'active':'' ?>" href="bt4/index.php?p=shop-user&act=<?= $k ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<div class="grid-2">
  <aside class="card" style="min-width:260px">
    <?php include $base . '/components/sidebar.php'; ?>
  </aside>

  <main class="card">
    <?php include $pageFile; ?>
  </main>
</div>
