<?php
// bt4/modules/calc/index.php

// map tab -> file trong /pages
$tabs = [
  'home'            => 'Home',
  'register'        => 'Register',
  'contact1'        => 'Contact1Page',
];

$page = $_GET['page'] ?? 'home';
if (!isset($tabs[$page])) $page = 'home';

// file cần nạp
$view = __DIR__ . '/pages/' . $page . '.php';
?>
<style>
  /* chỉ áp cho module này */
  .calc-tabs { display:flex; gap:8px; flex-wrap:nowrap; overflow:auto; padding:8px 0; }
  .calc-tabs .chip { white-space:nowrap; }
  .calc-panel { padding:12px 8px; }
</style>

<header class="inner-hero card">
  <nav class="chips calc-tabs" aria-label="Tabs">
    <?php foreach ($tabs as $k => $label): ?>
      <a class="chip <?= $k===$page ? 'active' : '' ?>"
         href="bt4/index.php?p=calc&page=<?= $k ?>">
        <?= htmlspecialchars($label) ?>
      </a>
    <?php endforeach; ?>
  </nav>
</header>

<section class="calc-panel">
  <?php include $view; ?>
</section>
