<?php
// 4.5 Session – Router End-user (Home | Login)
session_start();

// Sửa TÙY MÁY BẠN nếu base khác:
define('BASE', '/CNWAT/');

$PAGE = $_GET['page'] ?? 'home';
$file = __DIR__ . '/pages/' . basename($PAGE) . '.php';
if (!is_file($file)) $file = __DIR__ . '/pages/home.php';
?>
<section class="inner-hero card">
  <nav class="chips" aria-label="Session">
    <a class="chip <?= $PAGE==='home'?'active':'' ?>"
       href="<?= BASE ?>bt4/index.php?p=session&page=home">Home</a>
    <a class="chip <?= $PAGE==='login'?'active':'' ?>"
       href="<?= BASE ?>bt4/index.php?p=session&page=login">Login</a>
  </nav>
</section>

<section class="card">
  <?php include $file; ?>
</section>
