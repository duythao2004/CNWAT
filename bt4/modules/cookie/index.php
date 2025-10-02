<?php
// End-user: 2 tab Home, Login
$PAGE = $_GET['page'] ?? 'home';
$base = __DIR__;

$tabs = [
  'home'  => 'Home',
  'login' => 'Login',
];

$file = "$base/pages/$PAGE.php";
if (!is_file($file)) $file = "$base/pages/home.php";
?>
<section class="inner-hero card">
  <nav class="chips" aria-label="Cookie demo">
    <?php foreach ($tabs as $k => $label): ?>
      <a class="chip <?= $PAGE===$k?'active':'' ?>"
         href="bt4/index.php?p=cookie&page=<?= $k ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<section class="card">
  <?php include $file; ?>
</section>
